const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

function app() {
  return {
    month: '',
    year: '',
    no_of_days: [],
    blankdays: [],
    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

    events: [

    ],
    current_event_id: 1,
    event_title: '',
    event_start_date: '',
    event_end_date: '',
    event_start_time: '',
    event_end_time: '',
    event_theme: 'blue',

    themes: [
      {
        value: "blue",
        label: "Blue Theme"
      },
      {
        value: "red",
        label: "Red Theme"
      },
      {
        value: "yellow",
        label: "Yellow Theme"
      },
      {
        value: "green",
        label: "Green Theme"
      },
      {
        value: "purple",
        label: "Purple Theme"
      }
    ],

    openEventModal: false,
    openEventDetails: false,


    initDate() {
      let today = new Date();
      this.month = today.getMonth();
      this.year = today.getFullYear();
      this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();

      const xhttp = new XMLHttpRequest();
      xhttp.open("GET", "".concat('calendar/',this.year,'/',this.month+1), false);
      xhttp.send(null);
      const obj = JSON.parse(xhttp.responseText);

      //add to array every object
      for(let i=0; i<obj['periodical'].length;i++){
      this.events.push({
          event_start_date: new Date(today.getFullYear(), today.getMonth(), Number(obj['periodical'][i]['day']), 00, 00),
          event_end_date: new Date(today.getFullYear(), today.getMonth(), Number(obj['periodical'][i]['day']), 23, 59),
          event_title: obj['periodical'][i]['title'],
          event_theme: obj['periodical'][i]['event_theme'],
          event_id: this.current_event_id
        });
        this.current_event_id +=1;
      }
      for(let i=0; i<obj['household'].length;i++){
      this.events.push({
          event_start_date: new Date(obj['household'][i]['generation_date']),
          event_end_date: new Date(obj['household'][i]['generation_date']),
          event_title: obj['household'][i]['title'],
          event_theme: 'blue',
          event_id: this.current_event_id
        });
        this.current_event_id +=1;
      }
      for(let i=0; i<obj['proposal'].length;i++){
      this.events.push({
          event_start_date: new Date(obj['proposal'][i]['time_start']),
          event_end_date: new Date(obj['proposal'][i]['time_stop']),
          event_title: obj['proposal'][i]['title'],
          event_theme: 'green',
          event_id: this.current_event_id
        });
        this.current_event_id +=1;
      }
    },

    isToday(date) {
      const today = new Date();
      const d = new Date(this.year, this.month, date);

      return today.toDateString() === d.toDateString() ? true : false;
    },

    showEventModal(date) {
      // open the modal
      this.openEventModal = true;
      this.event_start_date = new Date(this.year, this.month, date, 00, 00);
      this.event_end_date = new Date(this.year, this.month, date, 23, 59);
    },

    addEvent() {
      if (this.event_title == '') {
        return;
      }

      this.events.push({
        event_start_date: this.event_start_date,
        event_end_date: this.event_end_date,
        event_title: this.event_title,
        event_theme: this.event_theme,
        event_id: this.current_event_id
      });
      this.current_event_id +=1;

      console.log(this.events);

      // clear the form data
      this.event_title = '';
      this.event_start_date = '';
      this.event_end_date = '';
      this.event_theme = 'blue';

      //close the modal
      this.openEventModal = false;
    },

    getNoOfDays() {
      let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

      // find where to start calendar day of week
      let dayOfWeek = new Date(this.year, this.month).getDay();
      let blankdaysArray = [];
      for ( var i=1; i <= dayOfWeek; i++) {
        blankdaysArray.push(i);
      }

      let daysArray = [];
      for ( var i=1; i <= daysInMonth; i++) {
        daysArray.push(i);
      }

      this.blankdays = blankdaysArray;
      this.no_of_days = daysArray;
    },

    showDetails(id){
      console.log(id);
      this.openEventDetails = true;
      this.event_title = this.events[id-1]['event_title'];
      this.event_start_date = this.events[id-1]['event_start_date'].toLocaleString();
      this.event_end_date = this.events[id-1]['event_end_date'].toLocaleString();
    },

    updateMonthlyEvents(){
      this.events = [];
      this.current_event_id = 1;
      console.log("update events");
      const xhttp = new XMLHttpRequest();
      xhttp.open("GET", "".concat('calendar/',this.year,'/',this.month+1), false);
      xhttp.send(null);
      const obj = JSON.parse(xhttp.responseText);
      //console.log(obj);
      //add to array every object
      for(let i=0; i<obj['periodical'].length;i++){
      this.events.push({
          event_start_date: new Date(this.year, this.month, Number(obj['periodical'][i]['day']), 00, 00),
          event_end_date: new Date(this.year, this.month, Number(obj['periodical'][i]['day']), 23, 59),
          event_title: obj['periodical'][i]['title'],
          event_theme: obj['periodical'][i]['event_theme'],
          event_id: this.current_event_id
        });
        this.current_event_id +=1;
      }
      for(let i=0; i<obj['household'].length;i++){
      this.events.push({
          event_start_date: new Date(obj['household'][i]['generation_date']),
          event_end_date: new Date(obj['household'][i]['generation_date']),
          event_title: obj['household'][i]['title'],
          event_theme: 'blue',
          event_id: this.current_event_id
        });
        this.current_event_id +=1;
      }
      for(let i=0; i<obj['proposal'].length;i++){
      this.events.push({
          event_start_date: new Date(obj['proposal'][i]['time_start']),
          event_end_date: new Date(obj['proposal'][i]['time_stop']),
          event_title: obj['proposal'][i]['title'],
          event_theme: 'green',
          event_id: this.current_event_id
        });
        this.current_event_id +=1;
      }
    }

  }
}
