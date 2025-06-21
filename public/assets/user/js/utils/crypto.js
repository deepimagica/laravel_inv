// Convert base64 key string to Uint8Array bytes
function base64ToUint8Array(base64) {
    return Uint8Array.from(atob(base64), c => c.charCodeAt(0));
}

window._encryptData = async function (dataObj, base64Key = window._cryptoKey) {
    const keyBytes = base64ToUint8Array(base64Key);
    const iv = crypto.getRandomValues(new Uint8Array(12));
    const key = await crypto.subtle.importKey(
        "raw",
        keyBytes,
        { name: "AES-GCM" },
        false,
        ["encrypt"]
    );

    const encoded = new TextEncoder().encode(JSON.stringify(dataObj));
    const encrypted = await crypto.subtle.encrypt(
        { name: "AES-GCM", iv: iv },
        key,
        encoded
    );

    const ciphertext = new Uint8Array(encrypted);
    const tag = ciphertext.slice(ciphertext.length - 16);
    const ct = ciphertext.slice(0, ciphertext.length - 16);

    const combined = new Uint8Array(iv.length + tag.length + ct.length);
    combined.set(iv, 0);
    combined.set(tag, iv.length);
    combined.set(ct, iv.length + tag.length);

    return btoa(String.fromCharCode(...combined));
};



const originalAjax = $.ajax;

$.ajax = function (options) {
    if (options.encrypt && options.data && typeof options.data === 'object') {
        const dataToEncrypt = { ...options.data };

        const deferred = $.Deferred();

        window._encryptData(dataToEncrypt, window._cryptoKey).then(encrypted => {
            options.data = {
                data: encrypted,
                _token: $('meta[name="csrf-token"]').attr('content'),
            };

            originalAjax(options)
                .done(data => deferred.resolve(data))
                .fail((jqXHR, textStatus, errorThrown) => deferred.reject(jqXHR, textStatus, errorThrown));
        }).catch(err => {
            deferred.reject(null, 'encryption_failed', err);
        });

        return deferred.promise();
    } else {
        return originalAjax(options);
    }
};

