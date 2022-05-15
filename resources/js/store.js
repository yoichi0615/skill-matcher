import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
    user: [{
      name:'abc'
    }]
}

const mutations =  {
  buildRoom(state, {loginUserId, userId}) {
    // console.log('unti:'+id)
    console.log('iiiii::::' + userId)
   let array = ["/user/", userId, "/room"];
   let url = array.join('')
   console.log('通信先のurl:'+ url)
   axios.post(url).then(res => {
     //トーク相手のid
     console.log('通信結果:' + res);
     let partnerId = res
     var array = ["/user/", loginUserId, "/room_redirect/", partnerId];
     // 作成したroomにそのまま移動
     const url = array.join('')
     window.location.href = url
   }).catch(function(error) {
     console.log(error)
   })
 },
}


const getters = {
    getUsername(state) {
      console.log('unnti');
        return state.user.name;
    }
}

const actions = {
  buildRoom({commit}, {loginUserId, userId}) {
    commit('buildRoom', {loginUserId, userId})
  }

}

export default new Vuex.Store({
    state,
    mutations,
    getters,
    actions
});