<template>
  <div>
    <textarea v-model="message"></textarea><br>
    <button type="button" @click="send">送信</button>
    <p v-for="(m, key) in messages" :key="key">
      <span v-text="m.created_at"></span>
      <span v-text="m.body"></span>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: '',
      messages: []
    }
  },
  methods: {
    send() {
      const url = '/ajax/chat';
      const params = { message: this.message };
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
    this.getMessages();
  }
};
</script>
