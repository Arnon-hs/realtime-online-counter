<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="lead text-center">Online Now</p>
                        <h1 class="text-center">{{ this.count }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
                window.Echo.join('counter')
                    .here(users => this.count = users.length)
                    .joining(user => this.count++)
                    .leaving(user => this.count--);
            }
        }
    }
</script>