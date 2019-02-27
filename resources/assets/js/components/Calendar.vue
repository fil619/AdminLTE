<template>
  <v-app>
    <div class="container">

      <v-form
   ref="form"
   v-model="valid"
   lazy-validation
 >

      <div class="modal fade" tabindex="-1" role="dialog" id="add_post_model">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Add Event on {{displaydate}}</h4>
                          </div>
                          <div class="modal-body">
                              <v-text-field
                                   v-model="eventinfo"
                                   :counter="20"
                                   label="Event"
                                   :rules="EventRules"
                                   required
                                 ></v-text-field>
                                <v-container>
                                  <v-layout row wrap>

                                    <v-flex xs12 sm6 md6>
                                      <v-text-field
                                      v-model="starttime"
                                        type="time"
                                        :rules="[v => !!v || 'Start Time is required']"
                                        label="Start(24-hour military time)"
                                        prepend-inner-icon="timer"
                                        box
                                      ></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                      <v-text-field
                                      v-model="endtime"
                                        type="time"
                                        :rules="[v => !!v || 'End Time is required' ,
                                                 v => (!!v && v) > this.starttime || 'End Date should be greater than start Date']"
                                        label="End(24-hour military time)"
                                        prepend-inner-icon="timer"
                                        box
                                      ></v-text-field>
                                    </v-flex>


                                  </v-layout>
                                </v-container>

                            <v-select
                             :items="type"
                             v-model="eventtype"
                             :rules="[v => !!v || 'Select Event Type']"
                             label="Event Type"
                             solo
                           ></v-select>
                          </div>
                          <div class="modal-footer">
                            <v-btn
                                :disabled="!valid"
                                color="success"
                                @click="addevent"
                              >
                                Add Event
                            </v-btn>
                            <v-btn
                                color="error"
                                data-dismiss="modal"
                              >
                                Cancel
                              </v-btn>

                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <!-- <button type="button" class="btn btn-primary" @click="addevent()">Submit</button> -->
                          </div>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </v-form>

            <v-form
         ref="updateform"
         v-model="validUpdate"
         lazy-validation
       >
              <div class="modal fade" tabindex="-1" role="dialog" id="edit_post_model">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Edit Event</h4>
                                  </div>
                                  <div class="modal-body">

                                    <!-- <md-field>
                                      <label>Event</label>
                                       <md-input v-model="updateevent"></md-input>
                                    </md-field> -->

                                    <v-text-field
                                         v-model="updateevent"
                                         :counter="20"
                                         label="Event"
                                         :rules="EventRules"
                                         required
                                       ></v-text-field>
                                        <v-container>
                                          <v-layout row wrap>

                                            <v-flex xs12 sm6 md6>
                                              <v-text-field
                                              v-model="update_start"
                                                type="time"
                                                label="Start(24-hour military time)"
                                                :rules="[v => !!v || 'Start Time is required']"
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
                                                :rules="[v => !!v || 'End Time is required' ,
                                                         v => (!!v && v) > this.update_start || 'End Date should be greater than start Date']"
                                                box
                                              ></v-text-field>
                                            </v-flex>
                                          </v-layout>
                                        </v-container>
                                    <v-select
                                     :items="type"
                                     v-model="updatetype"
                                     label="Event Type"
                                     :rules="[v => !!v || 'Select Event Type']"
                                     solo
                                   ></v-select>


                                  </div>
                                  <div class="modal-footer">
                                    <v-btn
                                        :disabled="!validUpdate"
                                        color="success"
                                        @click="editevent"
                                      >
                                        Update
                                    </v-btn>
                                    <v-btn
                                        color="warning"
                                        data-dismiss="modal"
                                      >
                                        Cancel
                                      </v-btn>
                                      <v-btn
                                          color="error"
                                          @click="delevent"
                                        >
                                          Delete
                                      </v-btn>
<!--
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="delevent()">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" @click="editevent()">Update</button> -->
                                  </div>
                              </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
                    </v-form>
                      <!-- <v-container grid-list-xl> -->
                        <v-layout
                          flex-child
                          wrap
                          style="overflow:hidden;"
                        >

                        <v-flex
                        xs12
                        md4
                        d-flex
                        >
                        <v-sheet
                        class="d-flex"
                        color="teal lighten-3"
                        height="600"
                        id="ListCalendar"
                        >
                        <full-calendar :config="configlist" :events="get_event" height="500"></full-calendar>
                      </v-sheet>
                    </v-flex>

                          <v-flex
                            xs12
                            md8
                          >
                            <v-sheet
                              class="d-flex"
                              color="grey lighten-3"
                              height="600"
                            >
                            <full-calendar :events="get_event" @event-selected="EventSelected"  @day-click="multipledate" :config="config" @event-drop="dragged" ></full-calendar>
                            </v-sheet>
                          </v-flex>


                        </v-layout>
                      <!-- </v-container> -->
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

      valid: true,
      validUpdate: true,
      EventRules: [
        v => !!v || 'Event is required',
        v => (v && v.length <= 20) || 'Event must be less than 20 characters'
      ],

      type: ['Personal', 'Business'],
      configlist:{
        defaultView:"listDay",
        allDay : false,
        agendaWeek:false,
        agendayDay:false,
        header: {
     left:   '',
     center: '',
     right:  ''
   }
      },
      config:{
        defaultView:"month",
        eventLimit: 3,
        allDay : false,
        agendaWeek:false,
        agendayDay:false,
        header: {
     left:   'prev,next today',
     center: 'title',
     right:  'month'
   }
      },
    active: false,
    Sel_day:'',
    value: null
    }
  },
  methods:{
    validate () {
    if (this.$refs.form.validate()) {
      this.snackbar = true;
      alert('all true')
    }
  },
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
      this.getcalendarevent();
    },
    onConfirm () {
      this.value = '';

      },
      multipledate(date)
      {
        this.date = date ;
        this.displaydate = date.format() ;

        this.$refs.form.reset();
        this.$refs.form.resetValidation();

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
  if (this.$refs.form.validate()) {
    this.snackbar = true;
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
  }
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


startdate = selevent.start._i;
enddate = selevent.end._i;
startdate = startdate.slice(11, 16);
enddate = enddate.slice(11, 16);
this.update_start = startdate;
this.update_end = enddate;


this.$refs.updateform.resetValidation();
  $("#edit_post_model").modal("show");
},

editevent(){
  if (this.$refs.updateform.validate()) {
    this.snackbar = true;
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
    start: this.update_startdate  +'T'+this.update_start+':00' ,
    end: this.update_enddate +'T'+this.update_end+':00' ,
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
    }
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
    $("#edit_post_model").modal("hide");
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
  .fc-scroller {
    height:600px !important;
  }
  #ListCalendar .fc-toolbar{
    display: none !important;

  }
</style>
