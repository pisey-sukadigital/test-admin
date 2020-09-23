let actions = {

    fetchData({ commit }, datas) {
        return new Promise((resolve, reject) => {
            let url = datas[0];
            let data = datas[1];
            if (url && data) {
                axios.get(url + '/' + data.id)
                    .then(response => {
                        if (response.status == '200') {
                            resolve(response);
                        } else {
                            console.log("response <> 200")
                        }
                    }).catch(err => {
                        reject(err)
                    });
            }
        })
    },

    fetchDatas({ commit }, url) {
        return new Promise((resolve, reject) => {
            axios.get(url).then(response => {
                if (response.status == '200') {
                    commit('FETCH_DATAS', response.data);
                    resolve(response);
                } else {
                    console.log("response <> 200")
                }
            }).catch(err => {
                reject(err)
            });
        })
    },

    deleteData({ commit }, datas) {
        return new Promise((resolve, reject) => {
            let url = datas[0];
            let data = datas[1];
            if (url && data) {
                axios.delete(url + '/' + data.id)
                    .then(response => {
                        if (response.status == '200') {
                            commit('DELETE_DATA', data)
                            resolve(response);
                        } else {
                            console.log("response <> 200")
                        }
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

export default actions