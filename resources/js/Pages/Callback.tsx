import { User } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { Text, Avatar, Button, MantineProvider, Title, Card, Center } from '@mantine/core';

interface PageProps {
  username: string,
  email: string
  avatar: string
}

export default function Callback(props: PageProps) {
  let { username, email, avatar } = props;
  return (
    <>
      <Head title="Callback" />
      <MantineProvider>
        <Center>
          <Card>
            <Title> Legoom App</Title>
            <br />
            <Text size="lg">{username}</Text>
            <Text size="md">{email}</Text>
            <Avatar src={avatar} />
          </Card>
        </Center>
      </MantineProvider>
    </>
  );
}
