<template>
    <v-app>
        <v-app-bar
            color="deep-purple accent-4"
            dense
            dark
        >
            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-toolbar-title>Realtime chat</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-app-bar>
        <v-container>
            <v-row justify="center" align-items="align-center">
                <v-col cols="8" sm="12" md="8">
                    <v-list max-height="500">
                        <v-list-item-group multiple>
                            <v-virtual-scroll
                                :items="messages"
                                :item-height="50"
                                height="300"
                            >
                                <template v-slot="{ item }">
                                    <v-list-item>
                                        <v-list-item-content>
                                            <v-list-item-title v-text="item"></v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </template>
                            </v-virtual-scroll>
                        </v-list-item-group>
                    </v-list>
                    <v-text-field
                        label="Type text"
                        single-lines
                        v-model="textMessages"
                        @keyup.enter="sendMessages"
                    ></v-text-field>
                </v-col>
                <v-col cols="4" sm="12" md="4">
                    <strong>Total online: </strong>
                    <span>{{countUsers}}</span>
                    <v-list two-line>
                        <v-list-item-group>
                           <v-list-item v-for="user in users">
                               <v-avatar color="indigo" size="36">
                                   <span class="white--text headline">{{user.name.toUpperCase().substr(0,2)}}</span>
                               </v-avatar>
                               <strong class="pl-2">{{user.name}}</strong>
                           </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
    export default {
        data() {
            return {
                messages: [],
                textMessages: '',
                countUsers: 0,
                users:[],
            }
        },
        mounted() {
            this.listen();
            this.online();
        },
        methods: {
            listen(){
                window.Echo.channel('chat')
                    .listen('Message',({message}) => {
                        this.messages.push(message);
                    });
            },
            online(){
                window.Echo.join('online')
                    .here((users) => {
                        this.users = users;
                        this.countUsers = users.length;
                    })
                    .joining((user) => {
                        this.users.push(user);
                        this.countUsers++;
                    })
                    .leaving((user) => {
                        this.users.splice(this.users.indexOf(user, 1));
                        this.countUsers--;
                    });
            },
            sendMessages(){
                if(this.textMessages !== '') {
                    axios.post('/messages', {body: this.textMessages})
                        .catch(error => {
                            console.log(error)
                        });
                    this.messages.push(this.textMessages);
                    this.textMessages = '';
                }
            }
        }
    }
</script>
<style>
    .v-application--wrap{
        min-height: 0;
    }
</style>