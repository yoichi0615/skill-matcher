<template>
  <div>
    <textarea v-model="message"></textarea><br>
    <button type="button" @click="send()">送信</button>
    <p v-for="(m, key) in messages" :key="key">
      {{name}}
      <span v-text="m.created_at"></span>
      <span v-text="m.body"></span>
    </p>
  </div>
</template>

<script>
export default {
  props: {
    userId: {
      type:Number,
      default:0
    },
    userName: {
      type:String,
      default: ''
    }
  },
  data() {
    return {
      message: '',
      messages: [],
      name:this.userName
    }
  },
  methods: {
    send() {
      const url = '/ajax/chat';
      const params = { message: this.message, userId: this.userId};
      axios.post(url, params)
        .then((response) => {
            // 通信成功後メッセージ初期化
            this.message = '';
        });
      },
      getMessages() {
        const url = '/ajax/chat';
        axios.get(url)
          .then((response) => {
            this.messages = response.data;
        });
      }
  },
  mounted() {
    console.log('userid'+ this.userId)
    // this.getMessages();
    Echo.channel('chat')
    .listen('ChatCreated', (e) => {
      console.log(e)
      this.getMessages();
    });
  }
};
</script>
