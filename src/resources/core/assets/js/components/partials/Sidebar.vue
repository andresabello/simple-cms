<template>
    <aside class="menu">
        <div v-for="(type, index) in menu">
            <ul class="menu-list">
                <li v-for="item in type">
                    <a @click="makeActive(item)" :href="item.url" :class="getActive(item)">
                        <i :class="item.icon" aria-hidden="true"></i> {{ item.name  }}
                    </a>
                    <ul v-if="item.children" class="menu-list" v-show="item.active">
                        <li  v-for="child in item.children">
                            <a :href="child.url"> <i :class="child.icon" aria-hidden="true"></i> {{ child.name }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script type="text/babel">

    export default {

        props: ['menu'],

        data () {
            return {
                isActive: false
            }
        },

        mounted() {

        },

        computed: {

        },

        methods: {

            makeActive(item){

                if(item.children)
                {

                    if(item.active && this.isActive)
                    {
                        item.active = false;
                        this.isActive = false;
                    }
                    else
                    {

                        _.forEach(this.menu, function(type, index) {

                            _.forEach(type, function(item, key) {

                                item.active = false;

                            });
                        });

                        item.active = true;
                        this.isActive = true;

                    }
                }


            },

            getActive(item) {

                if(typeof item.children == 'undefined')
                {
                    return item.active ? 'is-current' : '';
                }


                return this.isActive && item.active ? 'is-active' : (item.active ? 'is-current' : '');

            }
        }
    }
</script>