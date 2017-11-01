<template>
    <div>
        <group-chat v-for="group in groups" :initial-group="group" :key="group.id"></group-chat>
    </div>
</template>

<script>
    export default {
        props: ['initialGroups', 'user'],

        data() {
            return {
                groups: []
            }
        },

        mounted() {
            this.groups = this.initialGroups;

            Bus.$on('groupCreated', (group) => {
                group.users_count = group.users.length;
                this.groups.push(group);
            });

            this.listenForNewGroups();

            Bus.$on('leftGroup', (group) => {
                this.groups = this.groups
                    .filter(function (element) {
                        return element.id !== group;
                    });
            });

            this.$notify({
                group: 'foo',
                duration: 5000,
                text: 'Добро пожаловать в чат!'
            });
        },

        methods: {
            listenForNewGroups() {
                Echo.private('users.' + this.user.id)
                    .listen('GroupCreated', (e) => {
                        console.log(e);
                        let group = e.group;
                        group.users_count = group.users.length;
                        this.groups.push(group);
                    })
                    .listen('GroupChanged', (e) => {
                        console.log(e);
                        let groups = this.groups
                            .filter(function (element) {
                                return element.id === e.group_id;
                            });
                        groups[0].users_count--;
                        console.log('group', groups[0]);

                        this.$notify({
                            group: 'foo',
                            duration: 2000,
                            text: 'Пользователь ' + e.username + ' вышел из беседы ' + groups[0].name
                        });

                    });
            }
        }
    }
</script>
