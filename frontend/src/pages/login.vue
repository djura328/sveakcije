<template>
    <v-app id="inspire">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary" dense>
                                <v-toolbar-title>Login form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-form>
                                    <v-text-field prepend-icon="person" v-model="name" label="Login" type="text"></v-text-field>
                                    <v-text-field prepend-icon="lock" v-model="password" label="Password" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" @click="login">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import {mapState, mapGetters} from 'vuex'

    export default {
        data: () => ({
            drawer: null,
            name: '',
            password: ''

        }),
        props: {
            source: String
        },
        methods:{
            login(){
                this.$store.commit('user/setUser',{
                    id: 1,
                    name: this.name,
                    email: this.password
                })
                this.$router.push({name: 'dashboard'})
            }
        }
    }
</script>