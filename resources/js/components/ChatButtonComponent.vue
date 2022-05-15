<template>
  <div v-if="hadRoom">
    <a :href="roomLink(fLoginUserId, fUserId)">
      <button type="submit">トークルーム</button>
    </a>
  </div>
  <div v-else>
    <form @submit.prevent="buildRoom(fLoginUserId, fUserId)">
      <button type="submit">トークルーム（新規作成）</button>
    </form>
  </div>
</template>


<script>
export default {
  props: {
    loginUserId: {
      type: Number,
      default: 0
    },
    userId: {
      type: Number,
      default: 0
    },
    hasRoom: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      fLoginUserId: this.loginUserId,
      fUserId: this.userId,
      hadRoom: this.hasRoom,
    }
  },
  methods: {
    buildRoom(loginUserId, userId) {
    console.log('userid::'+ userId)
      this.$store.dispatch('buildRoom', {loginUserId: loginUserId, userId: userId})
    },
    roomLink(loginUserId, userId) {
      console.log('loginuserid:' + loginUserId);
      let linkArr = ['/user/', loginUserId, '/room_redirect/', userId]
      return linkArr.join('')
    }
  },
  mounted() {
    // this.getMessages();
    Echo.channel('chat')
    .listen('ChatCreated', (e) => {
      console.log(e)
      this.getMessages();
    });
  }
};
</script>

