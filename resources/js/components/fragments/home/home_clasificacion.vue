<template>
    <v-card>
        <v-toolbar flat>
            <v-card-title><u>CLASIFICACIÓN</u></v-card-title>
        </v-toolbar>
        <v-card-text>
            <v-data-table
            :headers="headers"
            :items="equiposList"
            :footer-props="{
                itemsPerPageOptions: [equiposList.length/2],
            }"
            class="elevation-8 ma-2 user-table"
            dense
            >
               <template v-slot:[`footer.page-text`]="items">
                  <span v-if="items.itemsLength > 0">
                     {{ items.pageStart }} - {{ items.pageStop }} de {{ items.itemsLength }}
                  </span>
               </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
   name: 'Plantilla',
   data() {
      return {
         headers: [
            {
                text: "Pos.",
                align: "center",
                width: '2%',
                sortable: false,
                value: "Posicion",
            },
            
            {
                text: "Equipo",
                align: "start",
                width: '77%',
                sortable: false,
                value: "Equipo",
            },

            {
                text: "J",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },

            {
                text: "G",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },

            {
                text: "E",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },

            {
                text: "P",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },

            {
                text: "GF",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },

            {
                text: "GC",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },

            {
                text: "Pts",
                align: "center",
                width: '3%',
                sortable: false,
                value: "Puntos",
            },
        ],

        equiposList: [
            {
               "Posicion": "1",
               "Equipo": "A.D. CHORRILLO DISTRITO VIII 'A'",
               "Puntos": "54"
            },
            {
               "Posicion": "2",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "3",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "4",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "5",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "6",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "7",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "8",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "9",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "10",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "11",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "12",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "13",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "14",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "15",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "16",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "17",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "18",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "19",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
            {
               "Posicion": "20",
               "Equipo": "XXXXXXXXX",
               "Puntos": "54"
            },
        ],

      }
   },

   methods: {
   }
};
</script>