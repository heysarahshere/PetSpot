require('./bootstrap');

$('.carousel').carousel();

Vue.component('comments', require('./components/Comments.vue'));

const app = new Vue({
    el: '#app'
});




