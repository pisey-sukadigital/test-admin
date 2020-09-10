 let mutations = {
     CREATE_DATA(state, data) {
         if (state.datas.data instanceof Array) {
             state.datas.data.unshift(data);
         } else {
             console.log('Not an array');
         }
     },
     FETCH_DATAS(state, datas) {
         return state.datas = datas;
     },
     DELETE_DATA(state, data) {
         let index = state.datas.data.findIndex(item => item.id === data.id)
         state.datas.data.splice(index, 1)
     }
 }
 export default mutations