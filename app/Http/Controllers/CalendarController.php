<?php
/*
To Do:
 - dodać obsługę dodawania zdarzeń z kalendarza: wybór daty, nazwa, wybór tabeli -> pokazanie dodatkowych wymaganych danych, zapis danych
 - dodać obsługę checlisty dla zdarzeń powtarzających się
 - dodać sekcję odpowiedzialną za planowanie wydarzeń

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acceptations;
use App\Models\PeriodicalEvent;
use App\Models\HouseholdingEvent;
use App\Models\EventsProposal;
use App\Models\EventsPlanner;
use Carbon\Carbon;

class CalendarController extends Controller
{
  public function index()
  {
    //return view
    return view('calendar.calendar');
  }

  public function getMonthlyEvents($yearNumber, $monthNumber)
  {
    //get periodical events
    $periodicalEvents = [];
    $periodicalEvents = PeriodicalEvent::select('title', 'type', 'day')->where('month', $monthNumber)->get();
    if(empty($periodicalEvents)){
      $periodicalEvents = [];
    }
    else {
      foreach ($periodicalEvents as $e) {
        switch ($e["type"]) {
          case 'Rocznica':
            $e["event_theme"] = 'yellow';
            break;
          case 'Święta':
            $e["event_theme"] = 'purple';
            break;
          default:
            $e["event_theme"] = 'red';
            break;
        }

      }
    }

    //get household events
    $householdEvents = [];
    $householdEvents = HouseholdingEvent::all();
    $finalEvents = [];
    foreach ($householdEvents as $e) {
      if($e['day_of_generation'] != NULL)
      {
        $e['actualDate'] = Carbon::create($yearNumber, $monthNumber,$e['day_of_generation'],00,00,00);
        array_push($finalEvents, ["title"=>$e['title'], "generation_date"=>$e['actualDate']]);
      }
      else {
        $actualDate = Carbon::create($e['generation_date']);
        while($actualDate->month < $monthNumber)
        {
          $actualDate->addWeeks($e['span_of_weeks']);
        }
        while($actualDate->month == $monthNumber){
          array_push($finalEvents, ["title"=>$e['title'], "generation_date"=>Carbon::createFromTimestamp($actualDate->getTimestamp(), 'Europe/Warsaw')]);
          $actualDate->addWeeks($e['span_of_weeks']);
        }
      }
    }
    //clean data (remove double "sprzątanie")
    foreach($finalEvents as $e)
    {
      if($e["title"] == "Sprzątanie szczegółowe")
      {
        $tmpDate = $e["generation_date"];
        $pos = 0;
        foreach($finalEvents as $tmpE)
        {
          if($tmpE["title"] == "Sprzątanie pobieżne" && $tmpE["generation_date"] == $tmpDate)
          {
            array_splice($finalEvents, $pos, 1);
          }
          $pos++;
        }
      }
    }

    //get planned events
    $eventsProposal = [];
    $finalDate = Carbon::create($yearNumber, $monthNumber,1,00,00,00);
    $from = date($yearNumber.'-'.$monthNumber.'-01');
    $to = date($yearNumber.'-'.$monthNumber.'-'.$finalDate->daysInMonth);
    $eventsProposal = EventsProposal::select('title', 'time_start', 'time_stop', 'estimated_cost_per_person')->where('accepted',1)->whereBetween('time_start',[$from, $to])->get();

    return response()->json(
      ['periodical'=>$periodicalEvents,
      'household'=>$finalEvents,
      'proposal'=>$eventsProposal
    ]
    );
  }

  public function tPMainPage(){
    $events = EventsProposal::select('title','time_start', 'time_stop', 'estimated_cost_per_person', 'accepted')->get();
    return view('calendar.calendar_planner_events', compact('events'));
  }

  public function getEventWithID($ID)
  {
    $table = EventsPlanner::all();
    if (empty($table[0])) {
      return view('calendar.calendar_planner_events_details');
    }
    $points = EventsPlanner::select()->where('event_ID', $ID)->get();
  }

  public function temporaryView(){
    return view("calendar.calendar_planner_acceptances");
  }

  public function createNewTripID(){
    $allData = [];
    $allData = EventsProposal::select('id')->get();

    if(empty($allData[0]))
    {
      $newID = 1;
      return CalendarController::getEventWithID($newID);
    }

    $theBiggestID = EventsProposal::select('id')->max('id')->get();
    $newID = $theBiggestID + 1;
    return redirect()->route('calendar/tripPlanner/'.$newID);
  }


}
