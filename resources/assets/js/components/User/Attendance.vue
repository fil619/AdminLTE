<template>
<v-app>
  <!-- <v-container fluid> -->
    <v-layout row >
      <v-flex xs12 md5 >
        <v-card dark tile flat color="error" min-height="600">
          <v-card-text>
            <v-data-table
              :headers="headers"
              :items="employee"
              :rows-per-page-items="[50]"
            >
              <template slot="items" slot-scope="props" >
                <td class="text-xs-right">{{ props.item.first_name}} {{ props.item.last_name }}</td>
                <td class="text-xs-right">{{ props.item.type }}</td>

                <td>
                  <span v-if="props.item.status == 'Not Available'"> <v-icon small class="mr-2" @click="checkin(props.item)" >radio_button_checked</v-icon></span>
                  <span v-else> <v-icon small class="mr-2" color="green darken-2">radio_button_checked</v-icon></span>
                </td>

                <td >
                  <span v-if="props.item.status == 'Available'"> <v-icon small class="mr-2" @click="checkout(props.item)" >radio_button_checked</v-icon></span>
                  <span v-else> <v-icon small class="mr-2" color="red darken-2">radio_button_checked</v-icon></span>
                </td>
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 md7>
        <v-card dark tile flat color="red darken-4" min-height="600">
          <v-card-text>

          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  <!-- </v-container> -->
</v-app>
</template>

<script>
export default {
  mounted()
  {
    this.getemployees();
  },
  data (){
    return {
      employee:[],
      headers: [
        { text: 'Name',     align: 'right',   value: 'first_name' , sortable: false  },
        { text: 'Department',    align: 'right',   value: 'type' , sortable: false },
        { text: 'Check in',    align: 'right',   value: 'in' , sortable: false },
        { text: 'Check Out',    align: 'right',   value: 'out' , sortable: false },
      ],
    }
  },
  methods:{
getemployees()
    {
      axios.get('/employee').then(response => {
      this.employee = response.data.employee  ;
       })
    },
    checkin(employee)
    {
      var moment = require('moment');
      axios.post('/attendance/checkin', {
      employee_id:employee.id,
      date:       moment().format('YYYY-MM-DD'),
      status:     'Present',
      checkin:    moment().format('HH:mm:ss'),
    })
        .then(response => {

        })
        axios.patch('/employee/status' , {
          employee_id:employee.id,
          status:"Available",
        })
        this.getemployees();
    },
    checkout(employee)
    {
      var moment = require('moment');
      axios.patch('/attendance/checkout' , {
        employee_id:employee.id,
        date:   moment().format('YYYY-MM-DD'),
        checkout:moment().format('HH:mm:ss'),
      })

          .then(response => {

    })
    axios.patch('/employee/status' , {
      employee_id:employee.id,
      status:"Not Available",
    })
    this.getemployees();
    }
  }
}
</script>
