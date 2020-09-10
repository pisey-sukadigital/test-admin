let actions = {
    createData({ commit }, datas) {
        let url = datas[0];
        let data = datas[1];
        if (url && data) {
            axios.post(url, data)
                .then(res => {
                    commit('CREATE_DATA', res.data);
                }).catch(err => {
                    console.log(err)
                })
        } else {
            console.log("Missing data");
        }
    },
    fetchDatas({ commit }, url) {
        axios.get(url)
            .then(res => {
                commit('FETCH_DATAS', res.data);
            }).catch(err => {
                console.log(err)
            })
    },
    deleteData({ commit }, datas) {
        let url = datas[0];
        let data = datas[1];
        if (url && data) {
            axios.delete(url + '/' + data.id)
                .then(res => {
                    if (res.data === 'ok')
                        commit('DELETE_DATA', data)
                }).catch(err => {
                    console.log(err)
                })
        } else {
            console.log("Missing data");
        }
    }
}

export default actions