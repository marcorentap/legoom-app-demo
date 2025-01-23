import { PageProps } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { Button, MantineProvider, Title } from '@mantine/core';

export default function Welcome() {
  return (
    <>
      <Head title="Welcome"/>
      <MantineProvider>
        <Title> Legoom App</Title>
        <br />
        <form method="GET" action="/redirect">
          <Button type="submit">Sign in with Legoom ID</Button>
        </form>
      </MantineProvider>
    </>
  );
}
