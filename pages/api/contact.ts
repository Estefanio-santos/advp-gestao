import { NextApiRequest, NextApiResponse } from 'next';

export default function handler(req: NextApiRequest, res: NextApiResponse) {
  if (req.method === 'POST') {
    // Processar dados do formulário de contato
    const { name, email, message } = req.body;
    // Aqui você conectaria com seu banco de dados para salvar os dados
    res.status(200).json({ message: 'Contato recebido com sucesso!' });
  } else {
    res.status(405).end(); // Método não permitido
  }
}
