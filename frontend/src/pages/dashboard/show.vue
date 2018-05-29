<template>
    <sa-layout-dashboard>
        <v-card class="ma-4">
            <v-card-title>
                Articles
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="articles"
                    :search="search"
            >
                <template slot="items" slot-scope="props">
                    <td class="text-xs-left">{{ props.item.name }}</td>
                    <td class="text-xs-left">{{ props.item.img }}</td>
                    <td class="text-xs-right">{{ props.item.price }}</td>
                    <td class="text-xs-right">{{ props.item.price_discount }}</td>
                    <td class="text-xs-right">{{ props.item.discount }}</td>
                    <td class="text-xs-centert">
                        <v-btn flat icon color="green darken-2" @click="edit(props.item)">
                            <v-icon>settings</v-icon>
                        </v-btn>
                        <v-btn flat icon color="red accent-4" @click.native.stop="dialog = true">
                            <v-icon>delete_outline</v-icon>
                        </v-btn>
                    </td>
                </template>
                <v-alert slot="no-results" :value="true" color="error" icon="warning">
                    Your search for "{{ search }}" found no results.
                </v-alert>
            </v-data-table>
        </v-card>

        <v-layout row justify-center>
            <v-dialog v-model="dialog" scrollable max-width="600">
                <v-card>
                    <v-card-title class="headline">Edit</v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field label="Name" v-model="itemEdit.name" required></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field label="Description" v-model="itemEdit.description" required></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-select
                                        v-model="itemEdit.company_id"
                                        :items="itemscompany_id"
                                        label="company_id"
                                        required
                                        item-text="name"
                                        item-value="id"
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12>
                                    <v-select
                                        v-model="itemEdit.category_id"
                                        :items="itemscategory_id"
                                        label="category_id"
                                        required
                                        item-text="name"
                                        item-value="id"
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field label="Price" v-model="itemEdit.price" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field label="Price with discount" v-model="itemEdit.price_discount"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                    <v-text-field suffix="%" label="Discount" v-model="itemEdit.discount" ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                        <small>*indicates required field</small>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" flat="flat" @click.native="dialog = false">Disagree</v-btn>
                        <v-btn color="green darken-1" flat="flat" @click="save">Agree</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </sa-layout-dashboard>
</template>

<script>
    import axios from 'axios'

    export default{
        data(){
            return{
                dialog: false,
                articles: [],
                search: '',
                headers: [
                    {
                        text: 'Name',
                        align: 'left',
                        sortable: false,
                        value: 'name'
                    },
                    { text: 'Image', align: 'left',value: 'img' },
                    { text: 'Price', align: 'right', value: 'price' },
                    { text: 'Price with discount', align: 'right',value: 'price_discount' },
                    { text: 'Discount', align: 'right', value: 'discount' },
                    { text: 'Options', align: 'center', value: 'options', sortable: false }
                ],
                itemscategory_id:[],
                itemscompany_id:[],
                itemEdit:{}
            }
        },
        created(){
            this.getArticles()
            this.getcategory_id()
            this.getcompany_id()
        },
        methods:{
            getArticles(){
                axios.get('http://localhost:8000/api/articles').then(res => {
                    console.log(res.data)
                    this.articles = res.data
                })
            },
            getcategory_id(){
                axios.get('http://localhost:8000/api/category').then(res => {
                    this.itemscategory_id = res.data
                })
            },
            getcompany_id(){
                axios.get('http://localhost:8000/api/company').then(res => {
                    this.itemscompany_id = res.data
                })
            },
            edit(item){
                this.dialog = true
                this.itemEdit = item
            },
            save(){
                axios.put('http://localhost:8000/api/articles/' + this.itemEdit.id, this.itemEdit
                ).then(res => {
                    this.dialog = false
                })
            }

        },
        watch:{
            itemEdit: {
                handler: function() {
                    this.itemEdit.discount = Math.round((1 - this.itemEdit.price_discount / this.itemEdit.price) * 100)
                },
                deep: true
            }
        }
    }

</script>