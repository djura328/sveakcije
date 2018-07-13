<template>
    <v-app id="inspire">
        <v-navigation-drawer
                :clipped="$vuetify.breakpoint.lgAndUp"
                v-model="drawer"
                fixed
                app
        >
            <v-list dense>
                <template v-for="item in items">
                    <v-layout
                            v-if="item.heading"
                            :key="item.heading"
                            row
                            align-center
                    >
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-flex>
                    </v-layout>
                    <v-divider
                            v-else-if="item.divider"
                            dark
                            class="my-3"
                    ></v-divider>
                    <v-list-group
                            v-else-if="item.children"
                            v-model="item.model"
                            :key="item.text"
                            :append-icon="item.model ? item.icon : item['icon-alt']"
                    >
                        <v-list-tile slot="activator">
                            <v-list-tile-content>
                                <router-link :to="{ name: item.link }" style="display: inline-flex">
                                    <v-list-tile-title>
                                        {{ item.text }}
                                    </v-list-tile-title>
                                </router-link>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile
                                v-for="(child, i) in item.children"
                                :key="i"
                                @click=""
                        >
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <router-link :to="{ name: item.link }" style="display: inline-flex">
                                    <v-list-tile-title>
                                        {{ child.text }}
                                    </v-list-tile-title>
                                </router-link>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                    <v-list-tile v-else :key="item.text" @click="">
                        <v-list-tile-content>
                            <router-link :to="{ name: item.link }" style="display: inline-flex">
                                <v-list-tile-title>
                                    {{ item.text }}
                                </v-list-tile-title>
                            </router-link>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
                <!--<template v-for="item in items">
                    <v-list-tile :key="item.text" @click="">
                        <v-list-tile-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <router-link :to="{ name: item.link }" style="display: inline-flex">
                                <v-list-tile-title>
                                    {{ item.text }}
                                </v-list-tile-title>
                            </router-link>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>-->
            </v-list>
        </v-navigation-drawer>
        <v-toolbar
                :clipped-left="$vuetify.breakpoint.lgAndUp"
                style="background-color: #0d456b"
                dark
                app
                fixed
                dense
        >
            <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <span class="title">SveAkcije</span>
                <!--<span class="hidden-sm-and-down" style="position: absolute;top: 12px;"><img src="static/images/sveakcije-w.png"/></span>-->
                <!--<span class="hidden-sm-and-down">Google Contacts</span>-->
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>apps</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>notifications</v-icon>
            </v-btn>
            <v-btn icon large>
                <v-avatar size="32px" tile>
                    <img
                            src="https://vuetifyjs.com/static/doc-images/logo.svg"
                            alt="Vuetify"
                    >
                </v-avatar>
            </v-btn>
        </v-toolbar>
        <v-content>
            <slot></slot>
        </v-content>
    </v-app>
</template>
<!--<template>
    <v-app
            id="inspire"
            dark
    >
        <v-navigation-drawer
                v-model="drawer"
                fixed
                clipped
                app
        >
            <v-list dense>
                <v-list-tile v-for="item in items" :key="item.text" @click="">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-subheader class="mt-3 grey&#45;&#45;text text&#45;&#45;darken-1">SUBSCRIPTIONS</v-subheader>
                <v-list>
                    <template v-for="item in items">
                        <v-list-tile :key="item.text" @click="">
                            <v-list-tile-action>
                                <v-icon>{{ item.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <router-link :to="{ name: item.link }" style="display: inline-flex">
                                    <v-list-tile-title>
                                        {{ item.text }}
                                    </v-list-tile-title>
                                </router-link>
                            </v-list-tile-content>
                        </v-list-tile>
                    </template>
                </v-list>
                <v-list-tile class="mt-3" @click="">
                    <v-list-tile-action>
                        <v-icon color="grey darken-1">add_circle_outline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title class="grey&#45;&#45;text text&#45;&#45;darken-1">Browse Channels</v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon color="grey darken-1">settings</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title class="grey&#45;&#45;text text&#45;&#45;darken-1">Manage Subscriptions</v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar
                color="red"
                dense
                fixed
                clipped-left
                app
        >
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-icon class="mx-3">fab fa-youtube</v-icon>
            <v-toolbar-title class="mr-5 align-center">
                <span class="title">Youtube</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-layout row align-center style="max-width: 650px">
                <v-text-field
                        :append-icon-cb="() => {}"
                        placeholder="Search..."
                        single-line
                        append-icon="search"
                        color="white"
                        hide-details
                ></v-text-field>
            </v-layout>
        </v-toolbar>
        <v-content>
            <slot></slot>
        </v-content>
    </v-app>
</template>-->

<script>
    import axios from '@/plugins/axios'

    export default {
        data: () => ({
            drawer: null,
            items: [
                { icon: 'history', text: 'Home', link: 'index' },
                { divider: true },
                { heading: 'Kategorije' }
                /*{ icon: 'contacts', text: 'Insert article'},
                { icon: 'content_copy', text: 'Duplicates' },
                { icon: 'settings', text: 'Settings' },
                { icon: 'chat_bubble', text: 'Send feedback' },
                { icon: 'help', text: 'Help' },
                { icon: 'phonelink', text: 'App downloads' },
                { icon: 'keyboard', text: 'Go to the old version' }*/
            ]
        }),
        props: {
            source: String
        },
        created(){
            axios.get('/category-menu').then(resp => {
                console.log(resp.data)
                resp.data.forEach(item => {
                    if(item.hasOwnProperty('children')){
                        let childrenArr = []
                        item.children.forEach(it => {
                            childrenArr.push({
                                icon: '',
                                text: it.name
                            })
                        })

                        this.items.push({
                            'text': item.name,
                            link: item.name,
                            icon: 'keyboard_arrow_up',
                            'icon-alt': 'keyboard_arrow_down',
                            model: false,
                            children: childrenArr
                        })
                    }
                    else{
                        this.items.push({
                            text: item.name,
                            icon: 'contacts',
                            link: item.name
                        })
                    }
                })

                /*{
                    icon: 'keyboard_arrow_up',
                        'icon-alt': 'keyboard_arrow_down',
                    text: 'Labels',
                    model: true,
                    children: [
                        { icon: 'add', text: 'Create label' }
                    ]
                },*/

            })
        }
    }
</script>

<style>
    a {
        text-decoration: none;
        color: #ababab!important;
    }
</style>