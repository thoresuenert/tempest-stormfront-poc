console.log('🌊');

// Storage for debounce/throttle timers
const timers = new WeakMap();
const throttleTimestamps = new WeakMap();

window.position = function(from, to ) {

    let toPosition = to.getBoundingClientRect();
    let fromPosition = from.getBoundingClientRect();
    let documentPosition = document.body.getBoundingClientRect();
    console.debug(
        {
            toPosition,
            fromPosition,
            documentPosition
        }
    )
    if(toPosition.bottom + fromPosition.height < documentPosition.height) {
        from.style.top = toPosition.bottom + 'px';
        from.style.left = toPosition.left + 'px';
    }

    if(toPosition.bottom + fromPosition.height > document.body.getBoundingClientRect().height) {
        from.style.top = toPosition.top - fromPosition.height + 'px';
        from.style.left = toPosition.left + 'px';
    }

}


import {morph, morphDocument} from "morphlex";
let mutateElements = (elements) => {
    for (const child of elements) {

        let target: Element = document.getElementById(child.id)!
        if (!target) {
            console.warn('Could not find a target for new content:', {
                element: { id: child.id },
            })
            continue
        }


        morph(target, child);
    }
}

let mutateDom = (elements) => {
    let newDocument = new DOMParser().parseFromString(elements, 'text/html');

    const hasHtml = /<\/html>/.test(elements);
    const hasHead = /<\/head>/.test(elements);
    const hasBody = /<\/body>/.test(elements);

    if(! (hasHtml || hasHead || hasBody)) {
       return mutateElements(newDocument.body.childNodes);
    }

    morphDocument(document, newDocument)
}

window.get = async function(url) {
    event.preventDefault();
    let target = event.target;
    let data;
    let form

    if(target instanceof HTMLFormElement) {
        form = target;
    }

    if(target instanceof  HTMLInputElement) {
        form = target.form;
    }

    data = new URLSearchParams(new FormData(form));
    let response = await fetch(`${url}?${data}`, {
        method: "GET",
        headers: new Headers([["Accept", "text/html, text/event-stream"]]),
    });

    if(response.headers.get('Content-Type').includes('text/event-stream')) {
        return await readEventStream(response.body.getReader());
    }

    mutateDom(await response.text());
}

window.post = async (url) => {
    event.preventDefault();
    let target = event.target;
    let data;
    let form

    if(target instanceof HTMLFormElement) {
        form = target;
    }

    if(target instanceof  HTMLInputElement) {
        form = target.form;
    }

    data = new FormData(form);

    data.append(document
        .querySelector('meta[name="csrf_name"]')
        .getAttribute("content"), document
        .querySelector('meta[name="csrf_token"]')
        .getAttribute("content"))

    let response = await fetch(url, {
        method: "POST",
        // Set the FormData instance as the request body
        body: data,

        headers: new Headers([["Accept", "text/html, text/event-stream"]]),
    });

    if(response.headers.get('Content-Type').includes('text/event-stream')) {
        return await readEventStream(response.body.getReader());
    }

    mutateDom(await response.text());
}

window.Key = {
    Enter: () => event.key === 'Enter' || event.keyCode === 13,
}
window.isEnter = function() {
    return event.key === 'Enter' || event.keyCode === 13;
};

window.show = function() {
    return event.command === '--show';
}


function createApi() {
    // Use a function as the base
    const baseFn = function(url) {
        return fetch(url);
    };

    // Add methods/properties to the function
    baseFn.someProperty = 'value';

    return new Proxy(baseFn, {
        get(target, prop) {
            // Handle property access
            return Reflect.get(target, prop);
        },
        apply(target, thisArg, args) {
            // Handle function calls
            return Reflect.apply(target, thisArg, args);
        }
    });
}

window.http = createApi();


// get('url')
// get.debounce(300).include(['#id1', '#id3', '.include'])('url')
// get.url(url).execute()


// handle event streams

async function readEventStream(reader) {
    const decoder = new TextDecoder();
    let buffer = '';

    while (true) {
        const { done, value } = await reader.read();

        if (done) {
            // Process any remaining data in buffer
            if (buffer.trim()) {
                processEvent(buffer);
            }
            break;
        }

        // Decode and add to buffer
        buffer += decoder.decode(value, { stream: true });

        // Process complete events (separated by double newline)
        const events = buffer.split('\n\n');

        // Keep the last incomplete event in buffer
        buffer = events.pop() || '';

        // Process all complete events immediately
        events.forEach(eventData => {
            if (eventData.trim()) {
                processEvent(eventData);
            }
        });
    }
}

function processEvent(eventData) {
    const lines = eventData.split('\n');
    const event = {
        type: null,
        data: []
    };

    lines.forEach(line => {
        if (line.startsWith('event: ')) {
            event.type = line.slice(7).trim();
        } else if (line.startsWith('data: ')) {
            event.data.push(line.slice(6));
        } else if (line.startsWith('data:')) {
            event.data.push(line.slice(5));
        }
    });

    if (event.type || event.data.length > 0) {
        const dataString = event.data.join('\n');

        // Handle your datastar-patch-elements event
        if (event.type === 'stormfront-patch-elements') {
            console.log('Datastar patch:', dataString);
            // Apply your DOM patch here
            mutateDom(dataString);
        } else if (event.type === 'stormfront-open-dialog') {
            console.log('Datastar patch:', dataString);
            // Apply your DOM patch here
            window[dataString].showModal();
        } else if (event.type === 'stormfront-close-dialog') {
            console.log('Datastar patch:', dataString);
            // Apply your DOM patch here
            window[dataString].close();
        } else {
            console.log('Event:', event.type, 'Data:', dataString);
        }
    }
}