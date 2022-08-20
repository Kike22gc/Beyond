<template>
    <v-card>
        <v-toolbar flat>
            <v-card-title><u>PROXIMO PARTIDO</u></v-card-title>
        </v-toolbar>
        <v-card-text>
            <v-row>
                <v-col cols="3">
                    <span style="font-size:2em">SAB</span>
                    <br>
                    <span style="font-size:3em">24 JUL</span>
                    <br><br>
                    <span style="font-size:2em">12:00</span>
                </v-col>
                <v-col cols="4" class="pl-8">
                    <v-img 
                    max-height="150"
                    max-width="150"
                    src="/images/escudos/1001.png">
                    </v-img>
                </v-col>
                <v-col cols="4" class="pl-8">
                    <v-img 
                    max-height="150"
                    max-width="150"
                    src="/images/escudos/3944.png">
                    </v-img>
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-spacer></v-spacer><h1>REAL MADRID C.F. INFANTIL 'A' (1)</h1><v-spacer></v-spacer>
            </v-row>
            <v-row>
                <v-col cols="4"></v-col>
                <v-col cols="4">
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="green">check_box</v-icon>
                </v-col>
                <v-col cols="4"></v-col>
            </v-row>
            <v-row class="mt-5">
                <v-spacer></v-spacer><h1>C.F. FUENLABRADA (5)</h1><v-spacer></v-spacer>
            </v-row>
            <v-row>
                <v-col cols="4"></v-col>
                <v-col cols="4">
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="yellow">indeterminate_check_box</v-icon>
                    <v-icon color="green">check_box</v-icon>
                    <v-icon color="yellow">indeterminate_check_box</v-icon>
                </v-col>
                <v-col cols="4"></v-col>
            </v-row>
            <v-row class="mt-3">
                <v-col cols="4">
                    <v-img max-height="150" max-width="150" src="/images/icons/icon_campo.png"></v-img><br>
                </v-col>
                <v-col cols="8">
                    <h3>CAMPO: SANTIAGO BERNABEU</h3><br>
                    <h3>DIRECCION: AV. CONCHA ESPINA, 1</h3><br>
                    
                </v-col>
            </v-row>
            <v-row>
                <v-spacer></v-spacer>
                <v-btn color="primary">VER PARTIDO</v-btn>
                <v-spacer></v-spacer>
            </v-row>
        </v-card-text>
    </v-card>
</template>