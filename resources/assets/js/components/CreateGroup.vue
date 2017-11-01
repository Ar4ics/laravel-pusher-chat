<template>
    <div class="panel panel-default">
        <div class="panel-heading">Создание беседы</div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <input class="form-control" type="text" v-model="name" placeholder="Имя беседы">
                </div>
                <div class="form-group">
                    <select class="selectpicker" title="Выберите пользователей..." v-model="users" multiple id="friends">
                        <option v-for="user in initialUsers" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="panel-footer text-center">
            <button type="submit" @click.prevent="createGroup" class="btn btn-primary">Создать</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['initialUsers'],

    data () {
        return {
            name: '',
            users: []
        }
    },

    methods: {
        createGroup () {
            axios.post('/groups', { name: this.name, users: this.users })
                .then((response) => {
                console.log(response.data);
                    this.name = '';
                    this.users = [];
                    $('.selectpicker').selectpicker('deselectAll');
                    Bus.$emit('groupCreated', response.data);
                });
        }
    }
}
</script>
