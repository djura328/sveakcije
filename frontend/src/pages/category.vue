<template>
    <sa-layout>
        <v-container fluid grid-list-md>
            <v-layout row wrap pb-4>
                <v-flex sm2>
                    <v-container fill-height>
                        <v-layout align-center>
                            <v-flex>
                                <h3 class="display-1">TOP Ponuda</h3>
                                <span class="body-1">
                                    Lorem ipsum dolor sit amet, pri veniam forensibus id.
                                </span>
                                <v-divider class="my-3"></v-divider>
                                <div class="title mb-3">Proverite zasto!</div>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
                <v-flex sm5>
                    <sa-card-large :article="articles[0]" v-if="articles[0]"></sa-card-large>
                </v-flex>
                <v-flex sm5>
                    <sa-card-large :article="articles[0]" v-if="articles[0]"></sa-card-large>
                </v-flex>
            </v-layout>

            <v-layout row wrap pt-4>
                <template v-for="article in articles">
                    <v-flex sm3>
                        <sa-card :article="article"></sa-card>
                    </v-flex>
                </template>
            </v-layout>
        </v-container>
    </sa-layout>
</template>

<script>
    import axios from '@/plugins/axios'
    import Card from '../components/sa-card'
    import CardLarge from '../components/sa-card-large'
    import cfg from '../config'

    export default {
        components: {
            'sa-card': Card,
            'sa-card-large': CardLarge
        },
        data: () => ({
            articles: [],
            firstArticle: [],
            cfg:cfg
        }),
        created(){
            axios.get('/category/1').then(resp => {
                this.articles = resp.data
                this.firstArticle = resp.data[0]
            })
        }
    }
</script>