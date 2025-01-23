import { User } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { Button, MantineProvider, Title } from '@mantine/core';

export default function Callback({ props }: { props: object}) {
  return (
    <>
      <Head title="Callback" />
      <MantineProvider>
        <Title> Legoom App</Title>
        <br />
        {JSON.stringify(props)}
      </MantineProvider>
    </>
  );
}
