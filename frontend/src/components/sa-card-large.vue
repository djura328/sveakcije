<template>
    <router-link :to="{name: 'article-id', params: {'id': article.id}}">
        <v-card>
            <v-layout row wrap>
                <v-flex xs6>
                    <v-card-title primary-title class="title-card-large">
                        <v-layout row wrap>
                            <v-flex xs12>
                                <div class="caption" style="color:gray">Gigatron</div>
                            </v-flex>
                            <v-flex xs12>
                                {{article.name}}
                            </v-flex>
                            <v-flex xs6 pa-0>
                                <div class="caption">
                                    <span style="color: #ff6a00;"><b>{{article.price_discount.toLocaleString('de-DE')}} RSD</b></span><br>
                                    <span style="text-decoration: line-through;">{{article.price.toLocaleString('de-DE')}} RSD</span>
                                </div>
                            </v-flex>
                            <v-flex xs6 pa-0 justify-center>
                                <sa-rating></sa-rating>
                            </v-flex>
                        </v-layout>
                    </v-card-title>
                </v-flex>
                <v-flex xs6>
                    <v-card-media :src="cfg.STORAGE + '/' + article.img" class="custom-card" height="240px"></v-card-media>
                </v-flex>
            </v-layout>
            <div class="stick">
                <span>{{article.discount}}%</span>
                <v-icon size="44px" color="red">local_offer</v-icon>
            </div>
        </v-card>
    </router-link>
</template>

<script>
    import Rating from '../components/sa-rating'
    import cfg from '../config'

    export default{
        props: {
            'article': {type: Object, required: true}
        },
        components: {
            'sa-rating': Rating
        },
        data(){
            return{
                cfg:cfg
            }
        }
    }
</script>

<style>

    .custom-card .card__media__background{
        background-size: contain!important;
    }

    .stick{
        position: absolute;
        top: 0;
        left: 0;
    }

    .stick span{
        position: absolute;
        top: 12px;
        left: 9px;
        transform: rotate(46deg);
        color: white;
    }

    .title-card-large{
        padding: 60px;
    }

</style>