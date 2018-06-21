<template>
    <sa-layout>
        <v-layout row wrap>
            <v-flex lg12>
                <sa-carousel
                     :perPage="1"
                     :autoplayHoverPause="true"
                     :autoplay="true"
                     :loop="true"
                     :paginationEnabled="false"
                >
                    <template v-for="(slide,i) in slides">
                        <sa-slide>
                            <a v-if="slide.link !== null" :href="slide.link" target="_blank"><img :src="slide.src" style="width: 100%;"></a>
                            <img v-else :src="slide.src" style="width: 100%;">
                        </sa-slide>
                    </template>
                </sa-carousel>
            </v-flex>
        </v-layout>
        <v-container grid-list-md text-xs-center>
            <v-layout row wrap >
                <v-flex lg1></v-flex>
                <v-flex lg10 pa-2>
                    <sa-category title="Preporučujemo za Vas"></sa-category>
                    <v-layout row wrap>
                        <template v-for="article in articles">
                            <v-flex lg3>
                                <sa-card :article="article"></sa-card>
                            </v-flex>
                        </template>
                    </v-layout>
                </v-flex>
                <v-flex lg1></v-flex>
            </v-layout>
        </v-container>
    </sa-layout>
</template>

<script>
    import axios from '@/plugins/axios'
    import Card from '../components/sa-card'
    import {mapState, mapGetters} from 'vuex'
    import { Carousel, Slide } from 'vue-carousel'
    import Category from '../components/sa-category'

    export default{
        components: {
            'sa-card': Card,
            'sa-carousel': Carousel,
            'sa-slide': Slide,
            'sa-category': Category,
        },
        data(){
            return{
                articles: [],
                slides: [
                    {src: 'static/images/baner1.jpg', link: ''},
                    {src: 'static/images/baner2.jpg', link: ''},
                    {src: 'static/images/baner3.jpg', link: ''}
                ]
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
                axios.get('articles').then(res => {
                    this.articles = res.data
                })
            }
        },
        computed:{
            ...mapGetters({user: 'user/get'})
        }
    }
</script>
<style>
    .card__media__background{
        /*background-size: contain!important;*/
    }
</style>