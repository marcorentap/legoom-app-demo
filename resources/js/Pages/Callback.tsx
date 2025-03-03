import { Head } from '@inertiajs/react';

interface PageProps {
    user: unknown;
}

export default function Callback(props: PageProps) {
    return (
        <>
            <Head title="Callback" />
            <p>Received data: {JSON.stringify(props, null, '  ')}</p>
        </>
    );
}
