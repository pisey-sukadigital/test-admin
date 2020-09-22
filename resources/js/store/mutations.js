 let mutations = {
     FETCH_DATAS(state, datas) {
         return state.datas = datas;
     },
     DELETE_DATA(state, data) {
         let index = state.datas.data.findIndex(item => item.id === data.id)
         state.datas.data.splice(index, 1)
     }
 }
 export default mutations