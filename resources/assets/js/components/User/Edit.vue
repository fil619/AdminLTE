<template>
  <v-app>
        <v-dialog v-model="dialog" persistent max-width="500">
          <v-card>
            <v-card-title style="background-color:#0d47a1 ; color:white ; padding-top: 30px;">
              <i class="nav-icon fas fa-users fa-2x"></i>
              <span class="title font-weight-light">EDIT EMPLOYEE</span>
            </v-card-title>

            <v-card-text>
                     <v-form
                         ref="form"
                         v-model="valid"
                         lazy-validation
                       >
                       <v-text-field
                         v-model="editemployee.id"
                         :rules="[  v => !!v || 'Employee ID is required']"
                         label="Employee ID(*)"
                         required
                         disabled
                       ></v-text-field>

                       <v-layout row wrap>
                       <v-flex xs5 md5
                       <v-text-field
                         v-model="editemployee.first_name"
                         :rules="nameRules"
                         label="First Name(*)"
                         :counter="30"
                         required
                       ></v-text-field>
                      </v-flex>

                      <v-flex xs5 md5  offset-xs2 offset-md2>
                        <v-text-field
                          v-model="editemployee.last_name"
                          :rules="nameRules"
                          label="Last Name(*)"
                          :counter="30"
                          required
                        ></v-text-field>
                      </v-flex>
                    </v-layout>
                         <v-text-field
                           v-model="editemployee.dob"
                           type = "date"
                           :rules="[  v => !!v || 'Date of Birth is required']"
                           label="D.O.B(*)"
                           required
                         ></v-text-field>

                         <v-text-field
                           v-model="editemployee.address"
                           :rules="[  v => !!v || 'Address is required']"
                           label="Address(*)"
                           required
                         ></v-text-field>

                         <!-- <v-textarea
                         v-model="editemployee.address"
                          outline
                          :rules="[  v => !!v || 'Address is required']"
                        ></v-textarea> -->

                        <v-layout row wrap>
                           <v-flex xs5 md5 >
                         <v-text-field
                         v-model="editemployee.telephone"
                         type="number"
                         label="Telephone"
                         ></v-text-field>
                       </v-flex>
                       <v-flex xs5 md5 offset-md2 offset-xs2>
                         <v-text-field
                         v-model="editemployee.phone_no"
                         type="number"
                         :rules="[  v => !!v || 'Phone Number is required', v => (v && v.length <= 10) || 'Phone Number must be less than 10 digits']"
                         label="Phone Number(*)"
                         :counter="10"
                         required

                         ></v-text-field>
                       </v-flex>
                     </v-layout>

                         <v-text-field
                           v-model="editemployee.email"
                           :rules="emailRules"
                           label="E-mail"

                         ></v-text-field>

                         <v-text-field
                           v-model="editemployee.adhar"
                           label="Adhar Card Number"
                           :counter="12"
                         ></v-text-field>


                         <v-select
                           v-model="editemployee.type"
                           :items="type"
                           :rules="[v => !!v || 'Employee type is required']"
                           label="Employee type(*)"
                           required
                         ></v-select>

                         <v-text-field
                           v-model="editemployee.joined_on"
                           type = "date"
                           label="Joined On(*)"
                           :rules="[  v => !!v || 'Joining Date is required']"
                           required
                         ></v-text-field>
                         <v-layout row wrap>
                        <v-flex xs5 md5
                         <v-text-field
                           v-model="editemployee.password"
                           label="Password(*)"
                           type="password"
                           :rules="[  v => !!v || 'Password is required']"
                           required
                         ></v-text-field>
                       </v-flex>
                     </v-layout>
                         <v-btn
                           :disabled="!valid"
                           color="success"
                           @click="validate"
                         >
                           Update
                         </v-btn>

                         <v-btn
                           color="error"
                           @click="dialog = false"
                         >
                           Close
                         </v-btn>
                       </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- <v-btn color="green darken-1" flat @click="dialog = false">Disagree</v-btn>
              <v-btn color="green darken-1" flat @click="dialog = false">Agree</v-btn> -->
            </v-card-actions>
          </v-card>
        </v-dialog>

    <v-layout
      flex-child
      wrap
      style="padding-top:10px"
    >
      <v-flex
        xs12
        md8
        d-flex
      >
        <v-layout wrap>

          <v-flex xs12 md12>
            <v-sheet
              class="d-flex"
              color="red lighten-3"
              min-height="560"
              xs12 md12
            >
            <v-card>
              <v-card-title>
                    Employee Directory
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="search"
                      append-icon="search"
                      label="Search"
                      single-line
                      hide-details
                    ></v-text-field>
                  </v-card-title>

                <v-data-table
                  :headers="headers"
                  :items="employee"
                  :search="search"
                  :rows-per-page-items="[10,25]"
                >
                  <template slot="items" slot-scope="props" >
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.first_name }}</td>
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.last_name }}</td>
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.type }}</td>
                    <td class="text-xs-right" @click="empselected(props.item)">{{ props.item.phone_no }}</td>
                    <td class="justify-center layout px-0">
                      <v-icon small class="mr-2" @click="editItem(props.item)" slot="activator">edit</v-icon>
                    </td>
                  </template>
                  <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                  </v-alert>
                </v-data-table>
              </v-card>
            </v-sheet>
          </v-flex>

        </v-layout>
      </v-flex>

      <v-flex
        xs12
        md4
        d-flex
      >
        <v-sheet
          color="grey lighten-3"
          height="690"
        >

        <v-container >
        <v-layout>
       <v-flex xs6 md6 >
         <v-card tile flat color="grey lighten-3">
           <v-card-text class="text-lg-right"><v-icon x-large>account_circle</v-icon></v-card-text>
         </v-card>
       </v-flex>
       <v-flex xs6 md6>
         <v-card  tile flat color="grey lighten-3" >
           <v-card-text class="text-lg-left">
             <strong v-if="clickedemployee">{{clickedemployee.first_name}}</strong><br>
              <div v-if="clickedemployee" >{{clickedemployee.type}}</div>
           </v-card-text>
         </v-card>
       </v-flex>
     </v-layout>
<v-divider inset></v-divider>
     <v-layout>
       <v-flex xs12 md12 sm12>
         <strong> <center>Personal Information</center></strong><br>
         <strong>Full Name : </strong>{{clickedemployee.first_name}} {{clickedemployee.last_name}}<br>
         <strong>D.O.B : </strong>{{clickedemployee.dob}}<br>
         <strong>Address : </strong>{{clickedemployee.address}}<br>
         <!-- <strong v-if="clickedemployee.adhar">Adhar : </strong>{{clickedemployee.adhar}}<br>
         <strong v-v-else>Adhar : </strong>Not Available<br> -->
         <strong>Adhar : </strong>{{clickedemployee.adhar}}<br>
       </v-flex>
     </v-layout>
<v-divider inset></v-divider>
     <v-layout>
       <v-flex xs12 md12 sm12>
         <strong> <center>Contact Information</center></strong><br>
         <strong>Telephone Number : </strong>{{clickedemployee.telephone}}<br>
         <strong>Mobile Number : </strong>{{clickedemployee.phone_no}}<br>
         <strong>Email : </strong>{{clickedemployee.email}}<br>
       </v-flex>
     </v-layout>
     <v-divider inset></v-divider>
     <v-layout>
       <v-flex xs12 md12 sm12>
         <strong> <center>Work Information</center></strong><br>
         <strong>Employee ID : </strong>{{clickedemployee.employee_id}}<br>
         <strong>Company ID : </strong>{{clickedemployee.company_code}}<br>
         <strong>Department : </strong>{{clickedemployee.type}} <br>
         <strong>Joining Date : </strong>{{clickedemployee.joined_on}}<br>
       </v-flex>
     </v-layout>


   </v-container>
        </v-sheet>
      </v-flex>

    </v-layout>
  </v-app>
</template>

<script>
  export default {
    components: {
      SheetFooter: {
        functional: true,

        render (h, { children }) {
          return h('v-sheet', {
            staticClass: 'mt-auto align-center justify-center d-flex',
            props: {
              color: 'rgba(0, 0, 0, .36)',
              dark: true,
              height: 50
            }
          }, children)
        }
      }
    },
    mounted()
    {
      this.getemployees();
    },
    data () {
      return {
        confirm: true,
        valid: true,
        password:'',
        confirmpassword:'',
        dialog: false,
        search: '',
        employee:[],
        clickedemployee:[],
        editemployee:[],
        headers: [
          { text: 'FirstName',     align: 'right',   value: 'first_name' },
          { text: 'Lastname',      align: 'right',   value: 'last_name' },
          { text: 'Department',    align: 'right',   value: 'type'},
          { text: 'Telephone No.', align: 'right',   value: 'phone_no'},
          { text: 'Actions', value: 'actions', sortable: false }
        ],
        type: [
          'Staff',
          'Mechanic',
          'Admin'
        ],
        nameRules: [
          v => !!v || 'Name is required',
          v => (v && v.length <= 30) || 'Name must be less than 30 characters'
        ],
        email: '',
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /.+@.+/.test(v) || 'E-mail must be valid'
        ],
      }
    },
    methods:{
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true

          axios.patch('/employee/update' + this.editemployee.id, {
            employee_id: this.editemployee.id,
            first_name: this.editemployee.first_name,
            last_name: this.editemployee.last_name,
            dob: this.editemployee.dob,
            address: this.editemployee.address,
            telephone: this.editemployee.telephone,
            phone_no: this.editemployee.phone_no,
            email: this.editemployee.email,
            adhar: this.editemployee.adhar,
            type: this.editemployee.type,
            password: this.editemployee.password,
            joined_on: this.editemployee.joined_on,
          })
              .then(response => {
                this.dialog = false
                this.getemployees();
        })

        }
      },
      reset () {
        this.$refs.form.reset()
      },
      getemployees()
      {
        axios.get('/employee').then(response => {
        this.employee = response.data.employee  ;
         })
      },
      empselected(employee)
      {
        this.clickedemployee = employee ;
      },
      editItem (item) {
        this.dialog = true
        this.editemployee = item ;
      }
    }
  }
</script>

<style>

</style>
