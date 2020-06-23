import 'font-awesome/css/font-awesome.min.css'
import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'

Vue.component('font-awesome-icon', FontAwesomeIcon)
library.add(fas)
Vue.use(Vuetify)

const opts = {
    icons: {
        iconfont: 'fa4'
    }
}

export default new Vuetify(opts)