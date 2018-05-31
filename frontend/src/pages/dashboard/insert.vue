<template>
    <sa-layout-dashboard>
        <v-container pa-4>
            <v-form ref="form" v-model="valid" lazy-validation>
                <v-card color="grey lighten-4" flat height="auto" tile>
                    <v-toolbar dense color="blue lighten-1">
                        <v-toolbar-title class="white--text">First page</v-toolbar-title>
                    </v-toolbar>
                    <div class="px-2">
                    <v-text-field
                            v-model="name"
                            :rules="nameRules"
                            :counter="30"
                            label="Name"
                            required
                    ></v-text-field>
                    <v-text-field
                            v-model="description"
                            :rules="nameRules"
                            label="Description"
                            :counter="30"
                            required
                    ></v-text-field>
                    <v-text-field
                            v-model="link"
                            :rules="nameRules"
                            label="link"
                            :counter="100"
                            required
                    ></v-text-field>
                    <v-select
                            v-model="company"
                            :items="itemsCompany"
                            :rules="[v => !!v || 'Item is required']"
                            label="Company"
                            required
                            item-text="name"
                            item-value="id"
                    ></v-select>
                    <v-select
                            v-model="category"
                            :items="itemsCategory"
                            :rules="[v => !!v || 'Item is required']"
                            label="Category"
                            required
                            item-text="name"
                            item-value="id"
                    ></v-select>
                    <v-text-field
                            suffix="Din"
                            v-model="price"
                            :rules="nameRules"
                            label="Price"
                            required
                    ></v-text-field>
                    <v-text-field
                            suffix="Din"
                            v-model="priceDiscount"
                            :rules="nameRules"
                            label="Price discount"
                            required
                    ></v-text-field>
                    <v-text-field
                            suffix="%"
                            v-model="discount"
                            label="Discount"
                            disabled
                    ></v-text-field>
                    </div>
                </v-card>
                <v-card color="grey lighten-4" flat height="auto" tile>
                    <v-toolbar dense color="blue lighten-1">
                        <v-toolbar-title class="white--text">Second page</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="addRow">
                            <v-icon color="white">add_box</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-layout row wrap>
                        <template v-for="(option, key) in options">
                            <v-flex xs6 px-2>
                                <v-text-field v-model="option.name" label="Name"></v-text-field>
                            </v-flex>
                            <v-flex xs5 px-2>
                                <v-text-field v-model="option.description" label="Descriptin"></v-text-field>
                            </v-flex>
                            <v-flex xs1>
                                <v-layout justify-end>
                                    <v-btn icon @click="addRow">
                                        <v-icon>indeterminate_check_box</v-icon>
                                    </v-btn>
                                </v-layout>
                            </v-flex>
                        </template>
                    </v-layout>
                </v-card>

                <v-layout column>
                    <v-flex>
                        <v-card color="grey lighten-4" flat height="auto" tile>
                            <v-toolbar dense color="blue lighten-1">
                                <v-toolbar-title class="white--text">Image</v-toolbar-title>
                            </v-toolbar>
                            <div class="px-2">
                                <div style="color:gray" class="py-2">Dimension: 162 x 162px</div>
                                <input type="file" id="fileInput" ref = "fileInput" />
                            </div>
                        </v-card>
                    </v-flex>
                    <v-flex pt-4>
                        <v-btn :disabled="!valid" @click="save" block color="secondary">
                            submit
                        </v-btn>
                    </v-flex>
                </v-layout>

            </v-form>
        </v-container>
    </sa-layout-dashboard>
</template>

<script>
    import axios from 'axios'

    export default{
        data(){
            return{
                valid:true,
                name:'',
                description:'',
                company:'',
                category:'',
                price:'',
                priceDiscount:'',
                discount:'',
                nameRules: [
                    v => !!v || 'Name is required',
                    /*v => (v && v.length <= 30) || 'Name must be less than 10 characters'*/
                ],
                itemsCompany:[],
                itemsCategory:[],
                options:[{name:'', description:''}]
            }
        },
        created(){
            this.getCategory()
            this.getCompany()
        },
        methods:{
            removeRow(){
                alert()
            },
            addRow(){
                this.options.push({name:'', description:''})
            },
            save(){
                if (this.$refs.form.validate()) {
                    var formData = new FormData();
                    formData.append('id', '1');
                    formData.append('image', this.$refs.fileInput.files[0]);

                    if (this.$refs.fileInput.files[0] !== undefined) {
                        // Upload image ----------------------------------------------------------- >
                        axios.post('http://localhost:8000/api/upload-image', formData).then(response => {
                            const nameImage = response.data.name
                            // Save article ----------------------------------------------------------- >
                            axios.post('http://localhost:8000/api/articles', {
                                name: this.name,
                                description: this.description,
                                link: this.link,
                                company_id: this.company,
                                category_id: this.category,
                                price: this.price,
                                price_discount: this.priceDiscount,
                                discount: this.discount,
                                img: nameImage,
                                data: JSON.stringify(this.options)
                            }).then(res => {
                                console.log(res)
                            })
                        })
                    }
                    else {
                        alert('Please add image')
                    }
                }
            },
            getCategory(){
                axios.get('http://localhost:8000/api/category').then(res => {
                    this.itemsCategory = res.data
                })
            },
            getCompany(){
                axios.get('http://localhost:8000/api/company').then(res => {
                    this.itemsCompany = res.data
                })
            }
        },
        watch:{
            price(){
                this.discount = Math.round((1 - this.priceDiscount / this.price) * 100)
            },
            priceDiscount(){
                this.discount = Math.round((1 - this.priceDiscount / this.price) * 100)
            }
        }
    }
</script>