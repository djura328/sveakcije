<template>
    <sa-layout>
        <v-container fluid grid-list-xl>
            <v-layout row wrap>
                <v-flex sm4>
                    <v-card>
                        <v-card-media :src="'http://localhost:8000/storage/' + article.img" height="400px"></v-card-media>
                    </v-card>
                </v-flex>
                <v-flex sm8>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <p class="headline">{{article.name}}</p>
                            <v-divider></v-divider>
                        </v-flex>
                        <v-flex xs12 px-4>
                            <v-layout row wrap align-baseline>
                                <v-flex xs3>
                                    Price:
                                </v-flex>
                                <v-flex xs9 style="text-decoration: line-through;">
                                    {{article.price}} RSD
                                </v-flex>
                                <v-flex xs3>
                                    Discount Price:
                                </v-flex>
                                <v-flex class="headline xs9 blue--text">
                                    <b>{{article.price_discount}} RSD</b>
                                    <div>
                                        <v-btn class="subheading ma-0 pa-0" small color="error">{{article.discount}}%</v-btn>
                                    </div>
                                </v-flex>
                                <v-flex xs3>Prodavac:</v-flex>
                                <v-flex xs9 v-if="article.company">
                                    {{article.company.name}}
                                </v-flex>
                                <v-flex xs3>Link:</v-flex>
                                <v-flex xs9 v-if="article.company">
                                    <a :href="article.company.link">{{article.company.link}}</a>
                                </v-flex>
                                <v-flex xs3></v-flex>
                                <v-flex xs9 v-if="article.company">
                                    <a :href="article.link" target="_blank">
                                        <v-btn color="error" dark class="ma-0 pa-0">Link ponude</v-btn>
                                    </a>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-flex>
                <v-flex sm12>
                    <div>
                        <v-tabs
                                v-model="active"
                                color="cyan"
                                dark
                                slider-color="yellow"
                        >
                            <v-tab>Opis</v-tab>
                            <v-tab>Specifikacija</v-tab>
                            <v-tab></v-tab>
                            <v-tab-item>
                                <v-card flat>
                                    <v-card-text>
                                        {{article.description}}
                                    </v-card-text>
                                </v-card>
                            </v-tab-item>
                            <v-tab-item>
                                <v-card flat>
                                    <v-card-text>
                                        <v-data-table
                                                :headers="headers"
                                                :items="article.data"
                                                hide-actions
                                                hide-headers
                                                class="elevation-1"
                                        >
                                            <template slot="items" slot-scope="props">
                                                <td>{{ props.item.name }}</td>
                                                <td class="text-xs-left">{{ props.item.description }}</td>
                                            </template>
                                        </v-data-table>
                                    </v-card-text>
                                </v-card>
                            </v-tab-item>
                        </v-tabs>
                    </div>
                </v-flex>
            </v-layout>
        </v-container>
    </sa-layout>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                headers: [
                    {
                        text: '',
                        align: 'left',
                        sortable: false,
                        value: 'name'
                    },
                    { text: 'Description', align: 'left', sortable: false, value: 'description' }
                ],
                article:[],
                active: null
            }
        },
        created(){
            axios.get('http://localhost:8000/api/articles/' + this.$route.params.id).then(resp => {
                this.article = resp.data
            })
        }
    }
</script>

<style>
    .card__media__background{
        background-size: contain!important;
    }
    .tabs__div a{
        color:white!important;
    }
</style>