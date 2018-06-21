<template>
    <sa-layout>
        <v-layout row wrap>
            <v-flex lg12>
                <sa-carousel :perPage="1"
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
            <!--<v-flex lg3 pl-3>
                <v-layout row wrap fill-height>
                    <v-flex xs12 d-flex>
                        <v-card class="elevation-0">
                            <v-card-media src="https://www.w3schools.com/howto/img_nature_wide.jpg" height="100%"></v-card-media>
                        </v-card>
                    </v-flex>
                    <v-flex xs12 d-flex>
                        <v-card class="elevation-0">
                            <v-card-media src="https://www.w3schools.com/howto/img_snow_wide.jpg" height="100%"></v-card-media>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>-->
        </v-layout>
        <v-container grid-list-md text-xs-center>
            <v-layout row wrap>
                <v-flex class="lg11 offset-lg1 text-lg-left pl-2 py-2">
                    <div style="width: 240px; border-bottom: 3px solid #ec2121;font-size: 22px;color: #525252;font-weight: 300;">Preporučujemo za Vas</div>
                </v-flex>
            </v-layout>
            <v-layout row wrap >
                <v-flex lg1></v-flex>
                <v-flex lg10 pa-2>
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

    export default{
        components: {
            'sa-card': Card,
            'sa-carousel': Carousel,
            'sa-slide': Slide
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