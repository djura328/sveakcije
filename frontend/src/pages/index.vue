<template>
    <sa-layout>
        <v-container grid-list-md text-xs-center>
            <v-layout row wrap>
                <template v-for="article in articles">
                    <v-flex lg3>
                        <sa-card :article="article"></sa-card>
                    </v-flex>
                </template>
            </v-layout>
        </v-container>
    </sa-layout>
</template>

<script>
    import axios from 'axios'
    import Card from '../components/sa-card'
    import {mapState, mapGetters} from 'vuex'

    export default{
        components: {
            'sa-card': Card
        },
        data(){
            return{
                articles: []
            }
        },
        created(){
            this.getArticles()
            this.$store.commit('user/setUser',{
                id: 1,
                name: 'nikola',
                email: 'djura328@yahoo.com'
            })
        },
        methods:{
            getArticles(){
                axios.get('http://localhost:8000/api/articles').then(res => {
                    this.articles = res.data
                })
            }
        },
        computed:{
            ...mapGetters({user: 'user/get'})
        }
    }
</script>