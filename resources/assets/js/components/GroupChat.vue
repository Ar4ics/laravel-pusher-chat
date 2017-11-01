<template>
    <div>
        <div class="panel panel-primary">
            <div class="panel-heading" id="accordion">
                <span class="glyphicon glyphicon-comment"></span> {{ group.name }} Участников: {{ group.users_count }}
                <div class="btn-group pull-right">
                    <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion-" :href="'#collapseOne-' + group.id">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <a type="button" class="btn btn-default btn-xs" @click="leftGroup">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>

                </div>
            </div>
            <div class="panel-collapse collapse" :id="'collapseOne-' + group.id">
                <div class="panel-body chat-panel">
                    <ul class="chat">
                        <li v-for="conversation in conversations" :key="conversation.id">
                            <!-- <span class="chat-img pull-left">
                                                                                                    <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                                                                                                </span> -->
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">{{ conversation.user.name }}</strong>
                                </div>
                                <p>
                                    {{ conversation.message }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Напишите сообщение..." v-model="message" @keyup.enter="store()" autofocus />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat" @click.prevent="store()">
                                Отправить</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['initialGroup'],

    data () {
        return {
            group: {
                id: 0,
                name: "",
                users_count: 0
            },
            conversations: [],
            message: '',
            group_id: this.initialGroup.id
        }
    },

    mounted () {
        console.log('group mounted!');
        this.group = this.initialGroup;
        this.conversations = this.initialGroup.conversations ? this.initialGroup.conversations : [];
        this.listenForNewMessage();


    },

    methods: {
        store () {
            axios.post('/conversations', { message: this.message, group_id: this.group.id })
                .then((response) => {
                    this.message = '';
                    this.conversations.push(response.data);
                });
        },

        leftGroup () {
            axios.post('/groups/' + this.group.id + '/leave')
                .then((response) => {
                    console.log(response);
                });
            Bus.$emit('leftGroup', this.group.id);

        },

        listenForNewMessage () {
            Echo.private('groups.' + this.group.id)
                .listen('NewMessage', (e) => {
                    // console.log(e);
                    this.conversations.push(e);
                });
        }
    }
}
</script>
