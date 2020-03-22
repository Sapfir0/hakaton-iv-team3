

async function post(url, params) {
    const options = {
        method:"post",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(params)
    };
    return await fetch(url, options);
}

export {post};