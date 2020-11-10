export default {

    fetchData({ commit }, datas) {
        return new Promise((resolve, reject) => {
            let url = datas[0];
            let data = datas[1];
            if (url && data) {
                axios.get(url + '/' + data.id)
                    .then(response => {
                        resolve(response);
                    }).catch(err => {
                        reject(err)
                    });
            }
        })
    },

    fetchDatas({ commit }, url) {
        return new Promise((resolve, reject) => {
            axios.get(url)
                .then(response => {
                    commit('FETCH_DATAS', response.data);
                    resolve(response);
                }).catch(err => {
                    reject(err)
                });
        })
    },

    createData({ commit }, datas) {
        return new Promise((resolve, reject) => {
            let url = datas[0];
            let form = datas[1];
            if (url && form) {
                form.post(url)
                    .then(({ data }) => {
                        commit('CREATE_DATA', data);
                    })
                    .catch(err => {
                        console.log(err)
                    });
            }
        })
    },

    deleteData({ commit }, datas) {
        return new Promise((resolve, reject) => {
            let url = datas[0];
            let data = datas[1];
            if (url && data) {
                axios.delete(url + '/' + data.id)
                    .then(response => {
                        commit('DELETE_DATA', data)
                        resolve(response);
                    }).catch(err => {
                        reject(err)
                    });
            }
        })
    },

    updateData({ commit }, datas) {
        return new Promise((resolve, reject) => {
            let url = datas[0];
            let data = datas[1];

            if (url && data) {
                axios.put(url, data)
                    .then(response => {
                        resolve(response);
                    }).catch(err => {
                        reject(err)
                    });
            }
        })
    },
}