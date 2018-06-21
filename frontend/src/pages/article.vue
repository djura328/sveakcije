<template>
    <sa-layout>
        <v-container fluid grid-list-xl>
            <v-layout row wrap>
                <v-flex sm4>
                    <v-card>
                        <v-card-media v-if="article.img" :src="'http://beodzetpotrcko.rs/api/public/storage/' + article.img" height="400px"></v-card-media>
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
                                <v-flex xs12>
                                    <social-sharing url="https://vuejs.org/" inline-template>
                                        <div>
                                            <network network="facebook">
                                                <i class="fab fa-facebook-square" style="font-size:36px;color:#3e5b99"></i>
                                            </network>
                                            <network network="googleplus">
                                                <i class="fab fa-google-plus-square" style="font-size:36px;color:#db4437"></i>
                                            </network>
                                            <network network="linkedin">
                                                <i class="fab fa-linkedin" style="font-size:36px;color:#0077b5"></i>
                                            </network>
                                            <network network="pinterest">
                                                <i class="fab fa-pinterest-square" style="font-size:36px;color:#bd081c"></i>
                                            </network>
                                            <network network="twitter">
                                                <i class="fab fa-twitter-square" style="font-size:36px;color:#1c94e0"></i>
                                            </network>
                                        </div>
                                    </social-sharing>
                                </v-flex>
                                <v-flex xs3>
                                    Cena:
                                </v-flex>
                                <v-flex xs9 style="text-decoration: line-through;font-size: 16px;" v-if="article.price">
                                    {{article.price.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2})}} RSD
                                </v-flex>
                                <v-flex xs3>
                                    Cena sa popustom:
                                </v-flex>
                                <v-flex class="headline xs9 blue--text" v-if="article.price_discount" style="font-weight: 400;">
                                    {{article.price_discount.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2})}} RSD
                                    <div class="subheading" style="background-color: #e40f0f;color: white;width: 78px;text-align: center;border-radius: 4px;">
                                       {{article.discount}}%
                                    </div>
                                </v-flex>
                                <v-flex xs3>Prodavac:</v-flex>
                                <v-flex xs9 v-if="article.company">
                                    <div style="font-size: 16px;">{{article.company.name}}</div>
                                </v-flex>
                                <v-flex xs3>Link:</v-flex>
                                <v-flex xs9 v-if="article.company">
                                    <a :href="article.company.link">{{article.company.link}}</a>
                                </v-flex>
                                <v-flex xs3></v-flex>
                                <v-flex xs9 v-if="article.company">
                                    <a :href="article.link" target="_blank">
                                        <v-btn color="error" dark class="ma-0 pa-0" outline>Link ponude</v-btn>
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
    import axios from '@/plugins/axios'
    import SocialSharing from 'vue-social-sharing'

    export default {
        components:{
            'social-sharing':SocialSharing
        },
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
                article:{},
                active: null,
            }
        },
        created(){
            axios.get('articles/' + this.$route.params.id).then(resp => {
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