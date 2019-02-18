<template>
  <div id="DisplayDirect">
    <notifications group="notifications" position="bottom right" :speed="10" />

    <md-dialog :md-active.sync="first">
        <md-tabs md-dynamic-height>
          <md-tab md-label="General">
            <md-field>
                 <label>Ledger</label>
                 <md-input v-model="clicked.ledger"></md-input>
            </md-field>
            <md-field>
                 <label>Amount</label>
                 <md-input v-model="clicked.amount"></md-input>
            </md-field>
            <md-field>
                 <label>Date</label>
                 <md-input v-model="clicked.date"></md-input>
            </md-field>
            <md-field>
                 <label>Narration</label>
                 <md-input v-model="clicked.narration"></md-input>
            </md-field>
          </md-tab>
        </md-tabs>

        <md-dialog-actions>
          <md-button class="md-primary" @click="deleteledger()">Delete</md-button>
          <md-button class="md-primary" @click="first = false">Close</md-button>
          <md-button class="md-primary" @click="updateledger()">Save</md-button>
        </md-dialog-actions>
      </md-dialog>

    <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header @md-selected="onSelect">
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Direct Expenses</h1>
        </div>

        <md-field md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Search by name..." v-model="search" @input="searchOnTable" />
        </md-field>
      </md-table-toolbar>

       <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="single">
        <md-table-cell md-label="date " md-sort-by="date">{{ item.date }}</md-table-cell>
        <md-table-cell md-label="type" md-sort-by="type">{{ item.type }}</md-table-cell>
        <md-table-cell md-label="ledger" md-sort-by="ledger">{{ item.ledger }}</md-table-cell>
        <md-table-cell md-label="amount" md-sort-by="amount">{{ item.amount }}</md-table-cell>
        <md-table-cell md-label="narration " md-sort-by="narration">{{ item.narration }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
const toLower = text => {
   return text.toString().toLowerCase()
 }

 const searchByName = (items, term) => {
   if (term) {
     return items.filter(item => toLower(item.ledger).includes(toLower(term)))
   }

   return items
 }

export default {
  data(){
      return {
      search: null,
      selected: [],
      searched: [],
      clicked: [],
      direct:[],
      first: false,
      }
    },
  mounted()
  {
    this.getledger();
  },
  methods:
  {
      onSelect (item) {
        this.selected = item;
        this.clicked = this.selected;
        this.first = true;
      },
    newUser () {
        window.alert('Noop')
      },
      searchOnTable () {
     this.searched = searchByName(this.direct, this.search)
      },
  getledger()
  {
    axios.get('setexpense/getiexpenses').then(response => {
    let listOfObjects = Object.keys(response.data.Expense).map((key) => {
     return response.data.Expense[key]
   })
      this.direct = listOfObjects  ;
      this.searched = this.direct
     })
  },
  updateledger()
  {
    axios.patch('/setexpense/update'+ this.clicked.id, {
      type: this.clicked.type,
      ledger: this.clicked.ledger,
      amount: this.clicked.amount,
      date: this.clicked.date,
      narration: this.clicked.narration,
    })
        .then(response => {
          this.first = false;
          this.getledger();

        })
  },
  deleteledger()
  {
    axios.delete('/setexpense/destroy' , {
      params: {
              id:this.clicked.id,
              }
    })
    .then(response => {
      this.first = false;
      this.getledger();

    })
  }
  }
}
</script>

<style lang="css" scoped>

.notifications {
  margin-bottom:5vh;
}
</style>
