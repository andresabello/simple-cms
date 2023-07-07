import Vue from 'vue'
import 'core-js/stable'
import Prism from 'prismjs'
import 'regenerator-runtime/runtime'
import 'prismjs/components/prism-scss'
import Velocity from 'velocity-animate'
import 'prismjs/themes/prism-tomorrow.css'
import 'prismjs/plugins/toolbar/prism-toolbar'
import 'prismjs/plugins/toolbar/prism-toolbar.css'
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard'

const ready = () => {
    if (document.querySelector('code')) {
        Prism.highlightAll()
    }
}

document.addEventListener('DOMContentLoaded', ready)

new Vue({
    el: '#app',
    data: {
        isMobile: window.innerWidth <= 991,
        menu: {
            active: window.innerWidth > 991
        },
        overlay: {
            active: false
        }
    },
    methods: {
        toggleMenu () {
            this.menu.active = !this.menu.active
        },
        beforeEnter (el) {
            if (this.isMobile) {
                this.overlay.active = true
            }
            el.style.display = 'block'
        },
        enter (el, done) {
            Velocity(el, {
                marginLeft: 0
            }, {
                complete: done
            }, {
                duration: 500
            })
        },
        leave (el, done) {
            Velocity(el, {
                marginLeft: '-100%'
            }, {
                complete: done
            }, {
                duration: 500
            }).then(() => {
                if (this.isMobile) {
                    this.overlay.active = false
                }
            })
        },
        afterLeave (el) {
            el.style.display = 'none'
        },
    },
    components: {
        'burger': (resolve) => require(
            ['./components/utilities/Burger.vue'],
            resolve,
        ),
    }
})
