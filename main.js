import Vue from 'vue'
import App from './App'
import axios from 'axios'
import x2js from 'x2js' //xml数据处理插件
// import listNavBar from '@/components/list-nav-bar';
import uniIcon from '@dcloudio/uni-ui/lib/uni-icon/uni-icon.vue';
import listNavBar from '@/components/list-nav-bar/list-nav-bar.vue';

Vue.component('listNavBar',listNavBar);
Vue.component('uniIcon',uniIcon);

Vue.prototype.$axios = axios;
Vue.prototype.$x2js = new x2js(); //创建x2js对象，挂到vue原型上

Vue.config.productionTip = false

App.mpType = 'app'

const app = new Vue({
    ...App
})
app.$mount()
