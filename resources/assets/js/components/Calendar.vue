<template>
    <div class="container">

      <div class="modal fade" tabindex="-1" role="dialog" id="add_post_model">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Add Event</h4>
                          </div>
                          <div class="modal-body">

                            <md-field>
                              <label>Event</label>
                               <md-input v-model="eventinfo"></md-input>
                            </md-field>

                            <div class="form-group">
                              <label for="sel1">Select list:</label>
                              <select class="form-control" v-model="eventtype">

                                <option >Personal</option>
                                <option>Business</option>
                              </select>
                            </div>

                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" @click="addevent()">Submit</button>
                          </div>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->


<full-calendar :events="get_event" @day-click="dateSelected"  @event-created="multipledate" :config="config" @event-resize="selected" @event-drop="dragged"  ></full-calendar>
    </div>
</template>

<script>
import 'fullcalendar/dist/fullcalendar.css';

    export default {
        name: 'DialogPrompt',
        mounted()
        {
          this.getcalendarevent();
        },
        data() {
    return {
      eventinfo:'',
      updateend:'',
      dragevent:'',
      eventtype:'',
      date:'',
      get_event:[],

      config:{
        defaultView:"month",
        allDay : false
      },
    active: false,
    Sel_day:'',
    value: null
    }
  },
  methods:{
    selected(fcevent){
      this.updateend = fcevent;
      axios.patch('/event/update'+ this.updateend.id, {
        id:this.updateend.id,
        end:this.updateend.end.format(),
      })
    },
    dragged(drevent){
      console.log(drevent);
      this.dragevent = drevent;
      axios.post('/event/dragevent', {
        id:this.dragevent.id,
        start:this.dragevent.start.format(),
        end:this.dragevent.end.format(),
      })
    },
    dateSelected(date, jsEvent, view)
    {
      // this.active = true;
      this.Sel_day = date.format();
    },
    onConfirm () {
      console.log(this.Sel_day);
      console.log(this.value);
      this.value = '';

      },
      multipledate(date)
      {
        this.date = date ;
        $("#add_post_model").modal("show");
},
getcalendarevent()
{
  axios.get('/event').then(response => {
  this.get_event = response.data.event  ;
   })
},
addevent()
{
  var colour ;
  if(this.eventtype == 'Personal')
  {
    colour = '#4a148c';
  }
  else
  {
    colour = '#004d40';
  }
  axios.post('/event', {
  title:this.eventinfo,
  type:this.eventtype,
  start: this.date.start.format(),
  end: this.date.end.format(),
  allDay:true,
  color:colour,
})
    .then(response => {
      this.eventtype = '';
      this.eventinfo = '';
      $("#add_post_model").modal("hide");
      this.getcalendarevent();
    })
},
  }
    }
</script>
<style media="screen">
  .fc-event{
    color: white !important;
  }
  .fc-time{
    font-size: 15px !important;
    font-weight: bold !important;
  }
</style>
