<template>
<div class="inbox_msg">
 <div class="inbox_people">
   <div class="headind_srch">
     <div class="recent_heading">
       <h4>Recent</h4>
     </div>
     <div class="srch_bar">
       <div class="stylish-input-group">
         <input type="text" class="search-bar" placeholder="Search" v-model="keyword" @keyup="searchRoomByUserName">
         <span class="input-group-addon">
         <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
         </span> </div>
     </div>
   </div>
   <div class="inbox_chat">
     <div v-for="userRoom in loginUserRooms" :key="userRoom.id">
         <div class="chat_list active_chat">
           <div class="chat_people">
             <div class="chat_img"> 
               <!-- あとでimageプロパティ追加する -->
               <div v-if="userRoom.user.image">
                 <img :src="userRoom.user.image">
               </div>
               <!-- デフォルト画像の設定 -->
               <div v-else>
                 <img src=""> 
               </div>
             </div>
             <div class="chat_ib">
               <p v-if="userRoom.last_message">{{userRoom.last_message.text}}</p>
               <p v-else>まだ会話はありません</p>
             </div>
           </div>
         </div>
     </div>
   </div>
 </div>
<!-- 子コンポーネントをinclude -->
<chat-component></chat-component>
 </div>
</template>
<script>
import ChatComponent from './ChatComponent'

export default {
  props: {
      loginUserId: {
      type: Number,
      default: 0
    },
      targetRoomId: {
      type: Number,
      default: 0
    },
  },
  components: {
    ChatComponent
  },
  data() {
    return {
      loginUserRooms: [],
      user: '',
      roomId: '',
      keyword: '',
      hereTargetRoomId: ''
    }
  },
  created() {
    this.hereTargetRoomId = this.targetRoomId
    this.getRoomInfo()
  },
  methods: {
    // クリックしたユーザーとのトーク画面に遷移させる
    chatLink(roomId) {
      let userId = this.loginUserId
      let urlInfo = ['/user/', userId, 'room_get', roomId]
      let url = urlInfo.join('')
      axios.get(url).then(res => {
        this.user = res.data
        this.roomId = roomId
      }).catch(function(error) {
        console.log(error)
      })
    },
    getRoomInfo() {
      //sessionでこちゃへの強制リダイレクト先があるか判定
     if(this.hereTargetRoomId) {
       this.chatLink(this.hereTargetRoomId)
       this.hereTargetRoomId = ''
     }
     let urlInfo = ["/user/", this.loginUserId, "/room_list_get"];
     let targetUrl = urlInfo.join('')
     axios.get(targetUrl).then(res => {
       this.loginUserRooms = res.data
       this.loginUserRooms.forEach(element => {
         let date = new Date(element.created_at)
         if(element.last_message) {
           element.last_message.month = d.toLocaleDateString('en-US', { month: 'long'}),
           element.last_message.month = element.last_message.month.slice(0, 3)
           element.last_message.date = date.getDate()
         }
       })
     }).catch(function(error) {
       console.log(error)
     })
    },
    searchRoomByUserName() {
      let keyword = this.keyword
      let rooms = this.chatRooms
      return rooms.forEach(function(room, index) {
        if(room.user.name.indexOf(keyword) !== -1) {
          rooms.splice(index, 1)
          rooms.unshift(room)
        }
      })
    }
  }
}
</script>
<style scoped>

</style>