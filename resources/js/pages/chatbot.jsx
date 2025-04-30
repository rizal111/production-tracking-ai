import { Head, Link } from '@inertiajs/react';
import axios from 'axios';
import { useState } from 'react';

const ChatBox = () => {
    const [messages, setMessages] = useState([]);
    const [input, setInput] = useState('');
    const [loading, setLoading] = useState(false);

    const apiUrl = window.appConfig.apiUrl;

    const sendMessage = async (e) => {
        e.preventDefault();
        if (!input.trim()) return;

        const userMessage = { role: 'user', text: input };
        setMessages((prev) => [...prev, userMessage]);
        setLoading(true);

        try {
            const res = await axios.post(`${apiUrl}/ask`, {
                question: input,
            });

            const botMessage = {
                role: 'bot',
                text: res.data.answer || 'No response.',
            };

            setMessages((prev) => [...prev, botMessage]);
        } catch (error) {
            setMessages((prev) => [...prev, { role: 'bot', text: 'Error fetching response.' }]);
        } finally {
            setInput('');
            setLoading(false);
        }
    };

    return (
        <div className="min-h-screen bg-gray-800">
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex p-5">
                <div className="w-14 flex-none ...">
                    <Link href="/database" className="py-6 text-center text-xl font-bold hover:text-[#ff7b02]">
                        Database
                    </Link>
                </div>
                <div className="w-64 flex-auto ...">
                    <h1 className="py-6 text-center text-3xl font-bold">AI Production Assistant</h1>
                </div>
                <div className="flex-none... w-32"></div>
            </div>

            <div className="mx-auto mt-10 max-w-2xl rounded-lg border bg-white p-4 shadow">
                <div className="h-96 space-y-2 overflow-y-auto border-b p-2">
                    {messages.map((msg, i) => (
                        <div key={i} className={`${msg.role === 'user' ? 'text-right text-blue-600' : 'text-left text-gray-700'}`}>
                            <p className="inline-block rounded-lg bg-gray-100 px-4 py-2">{msg.text}</p>
                        </div>
                    ))}
                    {loading && <p className="text-gray-400">Thinking...</p>}
                </div>

                <form onSubmit={sendMessage} className="mt-2 flex">
                    <input
                        className="flex-1 rounded-l-lg border px-3 py-2 text-black"
                        value={input}
                        onChange={(e) => setInput(e.target.value)}
                        placeholder="Ask about production efficiency..."
                    />
                    <button type="submit" className="rounded-r-lg bg-blue-600 px-4 py-2 text-white">
                        Send
                    </button>
                </form>
            </div>
        </div>
    );
};

export default ChatBox;
