import axios from 'axios'


export function requestpost(config,success,failure){
    const instance = axios.create({
        baseURL:'http://localhost:8888/projet-cdaw/BackEnd/src/api.php/',
        timeout: 5000,
        method: 'post',

    })

    instance(config).then(
        res =>{
            success(res)

        }).catch(err =>{
            failure(err)
        })
}

export function requestput(config, success, failure) {
    const instance = axios.create({
        baseURL: 'http://localhost:8888/projet-cdaw/BackEnd/src/api.php/',
        timeout: 5000,
        method: 'put',
    })
    instance.interceptors.request.use(
        config => {
            if (localStorage.getItem('Authorization')) {
                config.headers.Authorization = localStorage.getItem('Authorization');
                //console.log("11111111111111111111111111111111")
            }
            return config;
        },
        error => {
            return Promise.reject(error);
        });
    instance(config).then(
        res => {
            success(res)
            console.log(res);
        }).catch(err => {
            failure(err)
            console.log(err);
        })
}



export function requestget(config, success, failure) {
    const instance = axios.create({
        baseURL: 'http://localhost:8888/projet-cdaw/BackEnd/src/api.php/',
        timeout: 5000,
    })
    instance(config).then(
        res => {
            success(res)
            console.log(res);
        }).catch(err => {
            failure(err)
            console.log(err);
        })
}