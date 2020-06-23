<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="lead text-center">Online Now</p>
                        <h1 class="text-center">{{ this.countUsers }}</h1>
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
                countUsers: 0
            }
        },
        mounted() {
            this.listen();
        },
        methods: {
            listen() {
                window.Echo.join('counter')
                    .here(users => this.countUsers = users.length)
                    .joining(user => this.countUsers++)
                    .leaving(user => this.countUsers--);
                // window.Echo.channel('online')
                //     .listen('UserOnline', ({countUsers}) => {
                //         this.countUsers = countUsers;
                //     });
                // axios.post('/online', { body: this.countUsers});

            }
        }
    }
</script>