const token = document.getElementById('token');
const ndef = new NDEFReader();

async function startNfc() {
    ndef.scan();
    ndef.onreading = (event) => {
        for (const record of event.message.records) {
            if (record.recordType === "text") {
                token.value = new TextDecoder(record.encoding).decode(record.data);
            }
        }
    }
}

token.onclick = async () => {
    await startNfc();
};
