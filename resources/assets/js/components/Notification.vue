<template>
  <div id="NotBell">
       <ul>
           <li id="noti_Container">
               <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->

               <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
               <div id="noti_Button"><i class="material-icons">notifications</i></div>

               <!--THE NOTIFICAIONS DROPDOWN BOX.-->
               <div id="notifications">
                   <h3>Notifications</h3>
                   <div style="height:300px;">


                   </div>
                   <div class="seeAll"><a href="#">See All</a></div>
               </div>
           </li>
       </ul>
   </div>
</template>

<script>
import moment from 'moment'

$(document).ready(function () {
       $('#noti_Button').click(function () {
           $('#notifications').fadeToggle('fast', 'linear', function () {
               if ($('#notifications').is(':hidden')) {
               }
           });
           $('#noti_Counter').fadeOut('slow');

           return false;
       });
       $(document).click(function () {
           $('#notifications').hide();

           if ($('#noti_Counter').is(':hidden')) {
           }
       });
       $('#notifications').click(function () {
           return false;
       });
   });

export default {
  data() {
return {
  Notifyevent:'',
  counter:'',
}
},
    mounted()
    {
      this.getnotification()
      setInterval(function(){
        var CurrentDate = new Date();
        CurrentDate = moment(CurrentDate).format("YYYY-MM-DDTHH:mm");
        var addhour = moment(CurrentDate).add(1,'hours').format("YYYY-MM-DDTHH:mm");
        axios.get('/event/notification' , {
          params: {
                  CurrDate: CurrentDate,
                  EndDate: addhour,
                  }
        })
        .then(response => {
        this.Notifyevent = response.data.event  ;
        if (this.Notifyevent  != '' )
        {
          var title = this.Notifyevent[0].title;
          var start = this.Notifyevent[0].start;
          var end = this.Notifyevent[0].end;
          start = start.slice(11, 16);
          end = end.slice(11, 16);
          var type = this.Notifyevent[0].type;

          this.$notification.show( type + ' Event : '+ title  , {
            body: 'Starts At : '+ start + ' to ' + end,
            requireInteraction: true
          }, {})
        }
         })
       }.bind(this), 60000);
    },

    methods:{
      getnotification()
      {
        var CurrentDate = new Date();
        CurrentDate = moment(CurrentDate).format("YYYY-MM-DDTHH:mm:ss");
        var addhour = moment(CurrentDate).add(1,'hours').format("YYYY-MM-DDTHH:mm:ss");
        axios.get('/event/notification' , {
          params: {
                  CurrDate: CurrentDate,
                  EndDate: addhour,
                  }
        })
        .then(response => {
        this.Notifyevent = response.data.event  ;
        this.counter = this.Notifyevent.length ;

         })
      },
      notify () {


      }
    }
  }
</script>
<style media="screen" scoped>
#NotBell{
  margin-bottom: 10px;
  padding-bottom: 10px;
}
ul {
  list-style:none;
  margin:0;
  padding:12px 10px;
  height:21px;
}
ul li {
  float:left;
  font:13px helvetica;
  font-weight:bold;
  margin:3px 0;
}
ul li a {
  color:#FFF;
  text-decoration:none;
  padding:6px 15px;
  cursor:pointer;
}
ul li a:hover {
  background:#425B90;
  text-decoration:none;
  cursor:pointer;
}

#noti_Container {
  position:relative;
}

/* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
#noti_Button {
  width:25px;
  height:25px;
  line-height:25px;
  border-radius:50%;
  -moz-border-radius:50%;
  -webkit-border-radius:50%;
  margin:-3px 10px 0 10px;
  cursor:pointer;
}

/* THE POPULAR RED NOTIFICATIONS COUNTER. */
#noti_Counter {
  display:block;
  position:absolute;
  background:#E1141E;
  color:#FFF;
  font-size:12px;
  font-weight:normal;
  padding:1px 3px;
  margin:-8px 0 0 25px;
  border-radius:2px;
  -moz-border-radius:2px;
  -webkit-border-radius:2px;
  z-index:1;
}

/* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
#notifications {
  display:none;
  width:430px;
  position:absolute;
  top:30px;
  right:0;
  background:#FFF;
  border:solid 1px rgba(100, 100, 100, .20);
  -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
  z-index: 0;
}
/* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
#notifications:before {
  content: '';
  display:block;
  width:0;
  height:0;
  color:transparent;
  border:10px solid #CCC;
  border-color:transparent transparent #FFF;
  margin-top:-20px;
  margin-left:400px;
}

h3 {
  display:block;
  color:#333;
  background:#FFF;
  font-weight:bold;
  font-size:13px;
  padding:8px;
  margin:0;
  border-bottom:solid 1px rgba(100, 100, 100, .30);
}

.seeAll {
  background:#F6F7F8;
  padding:8px;
  font-size:12px;
  font-weight:bold;
  border-top:solid 1px rgba(100, 100, 100, .30);
  text-align:center;
}
.seeAll a {
  color:#3b5998;
}
.seeAll a:hover {
  background:#F6F7F8;
  color:#3b5998;
  text-decoration:underline;
}
</style>
