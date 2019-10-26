<template>

    <div class="panel panel-default">
        <div class="panel-body">
            <p class="lead">Online Now:
                <span class="user-counter">{{ this.count }}</span>
            </p>
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
                Echo.join('counter')
                    .here(users => this.count = users.length)
                    .joining(user => this.count++)
                    .leaving(user => this.count--);
            }
        }
    }
</script>
