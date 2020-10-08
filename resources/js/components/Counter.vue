
<template>
                    <div class="col-3">
                        <p class="lead text-center">Notifs</p>
                        <h1 class="text-center">{{ this.count }}</h1>
                    </div>
</template>

<script>
    var Vue = require('vue');
    
    export default {
        data() {
            return {
                count: 0
            }
        },
        mounted() {
            this.listen();
        },
        methods: {
            listen() {
                Echo.join('counter')
                    .here(notifications => this.count = notifications.length)
                    .joining(notification => this.count++)
                    .leaving(notification => this.count--);
            }
        }
    }
</script>
