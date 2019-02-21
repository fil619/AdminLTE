<template>
  <v-app>
    <div class="container">

      <div class="modal fade" tabindex="-1" role="dialog" id="add_post_model">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Add Event on {{displaydate}}</h4>
                          </div>
                          <div class="modal-body">

                            <md-field>
                              <label>Event</label>
                               <md-input v-model="eventinfo"></md-input>
                            </md-field>

                            <v-form>
                                <v-container>
                                  <v-layout row wrap>

                                    <v-flex xs12 sm6 md6>
                                      <v-text-field
                                      v-model="starttime"
                                        type="time"
                                        label="Start(24-hour military time)"
                                        prepend-inner-icon="timer"
                                        box
                                      ></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                      <v-text-field
                                      v-model="endtime"
                                        type="time"
                                        label="End(24-hour military time)"
                                        prepend-inner-icon="timer"
                                        box
                                      ></v-text-field>
                                    </v-flex>


                                  </v-layout>
                                </v-container>
                              </v-form>

                            <v-select
                             :items="type"
                             v-model="eventtype"
                             label="Event Type"
                             solo
                           ></v-select>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" @click="addevent()">Submit</button>
                          </div>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->

              <div class="modal fade" tabindex="-1" role="dialog" id="edit_post_model">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Edit Event</h4>
                                  </div>
                                  <div class="modal-body">

                                    <md-field>
                                      <label>Event</label>
                                       <md-input v-model="updateevent"></md-input>
                                    </md-field>

                                    <v-form>
                                        <v-container>
                                          <v-layout row wrap>

                                            <v-flex xs12 sm6 md6>
                                              <v-text-field
                                              v-model="update_start"
                                                type="time"
                                                label="Start(24-hour military time)"
                                                prepend-inner-icon="timer"
                                                box
                                              ></v-text-field>
                                            </v-flex>

                                            <v-flex xs12 sm6 md6>
                                              <v-text-field
                                              v-model="update_end"
                                                type="time"
                                                label="End(24-hour military time)"
                                                prepend-inner-icon="timer"
                                                box
                                              ></v-text-field>
                                            </v-flex>


                                          </v-layout>
                                        </v-container>
                                      </v-form>

                                    <v-select
                                     :items="type"
                                     v-model="updatetype"
                                     label="Event Type"
                                     solo
                                   ></v-select>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="delevent()">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" @click="editevent()">Update</button>
                                  </div>
                              </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->

<full-calendar :events="get_event" @event-selected="EventSelected"  @day-click="multipledate" :config="config" @event-drop="dragged" ></full-calendar>
    </div>
  </v-app>
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

      updateid:'',
      update_start:'',
      update_startdate:'',
      update_end:'',
      update_enddate:'',
      updatetype:'',
      updateevent:'',

      fullstart:'',
      fullend:'',
      displaydate:'',
      updateend:'',
      starttime:'',
      endtime:'',
      dragevent:'',
      eventtype:'',
      date:'',
      get_event:[],
      type: ['Personal', 'Business'],
      config:{
        defaultView:"listDay",
        allDay : false,
        agendaWeek:false,
        agendayDay:false,
        header: {
     left:   'prev,next today',
     center: 'title',
     right:  'listDay,month'
   }
      },
    active: false,
    Sel_day:'',
    value: null
    }
  },
  methods:{
    dragged(drevent){
      axios.patch('/event/update'+ drevent.id ,  {
        id: drevent.id,
        title: drevent.title,
        type: drevent.type,
        start:drevent.start.format(),
        end:drevent.end.format(),
        allDay:drevent.allDay,
        color:drevent.color,
      })
    },
    onConfirm () {
      this.value = '';

      },
      multipledate(date)
      {
        this.date = date ;
        this.displaydate = date.format() ;
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
  this.fullstart = this.date.format()+'T' + this.starttime +':00';
  this.fullend = this.date.format()+'T' + this.endtime +':00' ;
  axios.post('/event', {
  title:this.eventinfo,
  type:this.eventtype,
  start: this.fullstart,
  end: this.fullend,
  allDay:false,
  color:colour,
})
    .then(response => {
      this.eventtype = '';
      this.eventinfo = '';
      $("#add_post_model").modal("hide");
      this.getcalendarevent();
    })
},
EventSelected(selevent, jsEvent, view){
this.updateid = selevent.id;
this.updateevent = selevent.title;
this.updatetype = selevent.type;

var startdate = selevent.start._i;
var enddate = selevent.end._i;
startdate = startdate.slice(0, 10);
enddate = enddate.slice(0, 10);
this.update_startdate = startdate;
this.update_enddate = enddate;
  $("#edit_post_model").modal("show");
},

editevent(){
  var colour ;
  if(this.updatetype == 'Personal')
  {
    colour = '#4a148c';
  }
  else
  {
    colour = '#004d40';
  }
  axios.patch('/event/update'+ this.updateid ,  {
    id: this.updateid,
    title: this.updateevent,
    type: this.updatetype,
    start: this.update_startdate  +'T'+this.update_start,
    end: this.update_enddate +'T'+this.update_end,
    allDay:false,
    color:colour,
  }) .then(response => {
    $("#edit_post_model").modal("hide");
    this.updateevent='';
    this.updatetype='';
    this.update_startdate='';
    this.update_enddate='';
    this.update_start='';
    this.update_end='';
    this.getcalendarevent();

      })
},
delevent()
{
  console.log(this.updateid);
  axios.delete('/event/destroy' , {
    params: {
            id:this.updateid,
            }
  })
  .then(response => {
    this.getcalendarevent();
  })
}

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
