import { Head, Link } from '@inertiajs/react';
import axios from 'axios';
import { useState } from 'react';

const Database = ({ production_logs, operators, machines }) => {
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
                <div className="w-32 flex-none">
                    <Link href="/" className="py-6 text-center text-xl font-bold hover:text-[#ff7b02]">
                        AI Chat
                    </Link>
                </div>
                <div className="w-64 flex-auto">
                    <h1 className="text-center text-3xl font-bold">Database</h1>
                </div>
                <div className="w-32 flex-none"></div>
            </div>
            <div className="mx-auto mt-10 max-w-5xl rounded-lg p-4">
                <div className="p-4">
                    <h1 className="mb-4 text-2xl font-bold">Operator List</h1>
                    <div className="overflow-x-auto">
                        <table className="min-w-full border border-gray-200">
                            <thead>
                                <tr className="text-left">
                                    <th className="border px-4 py-2">ID</th>
                                    <th className="border px-4 py-2">Name</th>
                                    <th className="border px-4 py-2">Employee ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                {operators.map((operator) => (
                                    <tr key={operator.id}>
                                        <td className="border px-4 py-2">{operator.id}</td>
                                        <td className="border px-4 py-2">{operator.name}</td>
                                        <td className="border px-4 py-2">{operator.employee_id}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div className="p-4">
                    <h1 className="mb-4 text-2xl font-bold">Machine List</h1>
                    <div className="overflow-x-auto">
                        <table className="min-w-full border border-gray-200">
                            <thead>
                                <tr className="text-left">
                                    <th className="border px-4 py-2">ID</th>
                                    <th className="border px-4 py-2">Name</th>
                                    <th className="border px-4 py-2">Type</th>
                                    <th className="border px-4 py-2">Serial #</th>
                                    <th className="border px-4 py-2">Capacity</th>
                                    <th className="border px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {machines.map((machine) => (
                                    <tr key={machine.id}>
                                        <td className="border px-4 py-2">{machine.id}</td>
                                        <td className="border px-4 py-2">{machine.name}</td>
                                        <td className="border px-4 py-2">{machine.type}</td>
                                        <td className="border px-4 py-2">{machine.serial_number ?? '-'}</td>
                                        <td className="border px-4 py-2">{machine.capacity ?? '-'}</td>
                                        <td className="border px-4 py-2">{machine.status}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div className="p-4">
                    <h1 className="mb-4 text-2xl font-bold">Production Log</h1>
                    <div className="overflow-x-auto">
                        <table className="min-w-full border border-gray-200">
                            <thead>
                                <tr className="text-left">
                                    <th className="border px-4 py-2">ID</th>
                                    <th className="border px-4 py-2">Machine ID</th>
                                    <th className="border px-4 py-2">Operator ID</th>
                                    <th className="border px-4 py-2">Shift</th>
                                    <th className="border px-4 py-2">Produced</th>
                                    <th className="border px-4 py-2">Scrap</th>
                                    <th className="border px-4 py-2">Downtime</th>
                                    <th className="border px-4 py-2">Log Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {production_logs.map((production_log) => (
                                    <tr key={production_log.id}>
                                        <td className="border px-4 py-2">{production_log.id}</td>
                                        <td className="border px-4 py-2">{`${production_log.machine_id} ( ${machines[production_log.machine_id - 1].name} )`}</td>
                                        <td className="border px-4 py-2">{`${production_log.operator_id} ( ${operators[production_log.operator_id - 1].name} )`}</td>
                                        <td className="border px-4 py-2">{production_log.shift}</td>
                                        <td className="border px-4 py-2">{production_log.units_produced}</td>
                                        <td className="border px-4 py-2">{production_log.scrap_units}</td>
                                        <td className="border px-4 py-2">{production_log.downtime}</td>
                                        <td className="border px-4 py-2">{production_log.log_date}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Database;
